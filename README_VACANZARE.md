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
