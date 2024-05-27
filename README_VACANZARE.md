## Per cominciare

### **ATTENZIONE** È necessario almeno NODEJS >=20.x
#### **ATTENZIONE** in produzione sul plesk DISABILITARE Node.js dall'interfaccia e lanciarlo solo da ssh

1. ``` composer install ```
2. ``` npm install ```
3. ```php artisan breeze:install --dark```
4. ```php artisan volt:install```
5. Creare il file .env
6. Creare un db e configurare adeguatamente il file .env
7. ```php artisan key:generate```
8. ```php artisan migrate```
9. ```php artisan db:seed``` Aggiunti i personaggi come utenti
10. ```php artisan serve``` per far partire il server in locale
11. ```php artisan install:broadcasting``` per installare Reverb
12. ```npm run dev``` o ```npm run build``` in produzione per far partire VITE https://laravel.com/docs/11.x/vite#running-vite
13. ```php artisan reverb:start``` per far partire Reverb
14. ```php artisan queue:work``` Non so ancora se mi servirà per Reverb, ma intanto lo scrivo per non scordarmelo

## Parametri discord
```
DISCORD_TOKEN=MTIzNTcwMjU1MTIyMzk5MjM5Mg.GqOxs4.c1wXoJqcUTDD65zho0wyNM2WmL32Nan9gK_GwA
DISCORD_APPLICATION_ID=1235702551223992392
DISCORD_PUBLIC_KEY=f06d2752800024aa7d44ba00815c9a47f995cf0f3b8fc50eef9767862dffd63d
```
## Parametri Reverb 
```
REVERB_APP_ID=vacanzare
REVERB_APP_KEY=dedadventure
REVERB_APP_SECRET=escaperoom
```
## Installare RAY

```composer require spatie/laravel-ray --dev```

```php artisan ray:publish-config```

## Creare una nuova notification

```php artisan make:notification <nome notification>```

```
APP_NAME=Vacanzare
APP_ENV=local
APP_KEY=base64:Za5+iJ9mL7c9OdAwrLrLq5Q/EFs0pbqMZhGdwShRf+Y=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vacanzareProduzione
DB_USERNAME=vacanzare.com_beatrice
DB_PASSWORD=Silvestro-123

BROADCAST_DRIVER=reverb
BROADCAST_CONNECTION=reverb
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

REVERB_SERVER_HOST=127.0.0.1
REVERB_SERVER_PORT=8080
REVERB_APP_ID=vacanzare
REVERB_APP_KEY=dedadventure
REVERB_APP_SECRET=escaperoom
REVERB_HOST=vacanzare.com
REVERB_PORT=443
REVERB_SCHEME=https
REVERB_CERT=

DISCORD_API_BOT_TOKEN=MTIzNTcwMjU1MTIyMzk5MjM5Mg.GqOxs4.c1wXoJqcUTDD65zho0wyNM2WmL32Nan9gK_GwA
DISCORD_APPLICATION_ID=1235702551223992392
DISCORD_PUBLIC_KEY=f06d2752800024aa7d44ba00815c9a47f995cf0f3b8fc50eef9767862dffd63d

SENTRY_LARAVEL_DSN=https://5dceb9d4158744f708c32a0460412b87@o4507296064798720.ingest.de.sentry.io/4507303784349776
SENTRY_TRACES_SAMPLE_RATE=1.0

VITE_REVERB_APP_ID=${REVERB_APP_ID}
VITE_REVERB_APP_KEY=${REVERB_APP_KEY}
VITE_REVERB_APP_SECRET=${REVERB_APP_SECRET}
VITE_REVERB_HOST=${REVERB_HOST}
VITE_REVERB_PORT=${REVERB_PORT}
VITE_REVERB_SCHEME=${REVERB_SCHEME}
VITE_APP_NAME="${APP_NAME}"
VITE_SENTRY_DSN_PUBLIC="${SENTRY_LARAVEL_DSN}"
```