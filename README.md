# vacanzare.com — D&D Character Sheet Reveal

Sistema per sessioni D&D online: l'admin sblocca progressivamente i pezzi della scheda personaggio di ogni giocatore. I giocatori vedono la propria board via link personalizzato; le board sono indipendenti tra loro.

Guarda una breve demo in italiano [qui](https://youtu.be/Ge92hipHCwA).

---

## Stack

- **Backend**: PHP 8.5 · Laravel 12 · Livewire 3
- **Frontend**: Blade · Tailwind · Vite 8 · Axios 1.16
- **Database**: MySQL (`vacanzare`)
- **Prod**: Ionos · `APP_DEBUG=false`
- **Locale**: Herd (`http://vacanzare.com.test`)

---

## Architettura

### Real-time: polling client-side
Il player board si aggiorna in tempo reale tramite polling HTTP ogni 4 secondi:

- `GET /board/stream/{game}` → `BoardStreamController@stream` → JSON degli `shows` del player
- Lato client: `setInterval` + `fetch` in `dashboard-player.blade.php`
- Ogni richiesta dura ~20ms e rilascia subito il worker PHP-FPM (no connessioni persistenti)

> Non usa Pusher, WebSocket o SSE — la scelta di polling è intenzionale per compatibilità con hosting condiviso Ionos.

### Autenticazione
- **Admin**: email + password (Livewire login)
- **Player**: magic link (`/verify-login/{token}/{game}?signature=...`), scade in 2 giorni; nessun Sanctum

### Notifiche Discord
I link di login vengono inviati ai giocatori via DM Discord tramite bot (`DISCORD_API_BOT_TOKEN`).

---

## Modelli principali

| Modello | Tabella | Note |
|---|---|---|
| `User` | `users` | `is_admin` distingue admin da player; `token` per magic link |
| `Character` | `characters` | Immagini in `storage/app/public/images/schede/{id}.png` |
| `Show` | `shows` | Pivot user/game/type/show(bool) — visibilità parti scheda |
| `Game` | `games` | `players_count`, `status` (ongoing/finished/suspended) |

Relazione: `User ↔ Character ↔ Game` via pivot `users_games_characters` (user_id, game_id, character_id).

`Show.type` = `TypeEnum`: `skill | spell | characteristic | equipment`

---

## Routing

```
GET  /                                      WelcomeController@gamesList
GET  /dashboard                             admin only
GET  /dashboard-player/{game}               player board (auth)
GET  /board/stream/{game}                   JSON shows (auth, polling)
GET  /verify-login/{token}/{game}           magic link login
GET  /admin/game/{game}                     GameController@page
GET  /admin/player/{user}/{fase}/{game}/show  UserGameController@toggle
```

---

## Flusso admin

1. `/admin/game/{game}` — lista giocatori, toggle visibilità parti scheda
2. `GET /admin/player/{user}/{fase}/{game}/show` → `UserGameController@toggle` — aggiorna `shows.show`; il client del player rileva il cambio entro ~4s

---

## Setup locale

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
```

Variabili d'ambiente richieste (vedi `.env.example`):

```
APP_NAME, APP_KEY, APP_URL
DB_DATABASE, DB_USERNAME, DB_PASSWORD
DISCORD_API_BOT_TOKEN, DISCORD_APPLICATION_ID, DISCORD_PUBLIC_KEY
SENTRY_LARAVEL_DSN
```

---

## Note tecniche

- **PHP 8.5 + Laravel 12**: `AppServiceProvider::register()` contiene un workaround per `ContainerCommandLoader` che non chiama `setLaravel()`.
- **config/database.php**: usa `\Pdo\Mysql::ATTR_SSL_CA` (deprecazione PHP 8.5 di `PDO::MYSQL_ATTR_SSL_CA`).
- `BROADCAST_DRIVER=log` — broadcasting disabilitato.
- Log configurato con driver `daily` (14 giorni di retention). Su prod usare `LOG_LEVEL=error`.
