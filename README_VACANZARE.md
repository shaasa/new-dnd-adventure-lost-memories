## Per cominciare

### **ATTENZIONE** È necessario almeno NODEJS >=20.x
#### **ATTENZIONE** in produzione sul plesk DISABILITARE Node.js dall'interfaccia e lanciarlo solo da ssh

1. ``` composer install ```
2. ``` npm install ```
3. ```php artisan breeze:install --dark```
4. Creare il file .env
5. Creare un db e configurare adeguatamente il file .env
6. ```php artisan key:generate```
7. ```php artisan migrate```
8. ```php artisan db:seed``` Aggiunti i personaggi come utenti
9. ```php artisan serve``` per far partire il server in locale
10. ```php artisan install:broadcasting``` per installare Reverbe
11. ```npm run dev``` o ```npm run build``` in produzione per far partire VITE https://laravel.com/docs/11.x/vite#running-vite
12. ```php artisan reverb:start``` per far partire Reverbe

##Parametri discord

DISCORD_API_BOT_TOKEN=MTIzNTcwMjU1MTIyMzk5MjM5Mg.GccaCL.8vuABaVlwLU81GBI_Ni0JQ_7wRLrecPL1U5S8k
DISCORD_APPLICATION_ID=1235702551223992392
DISCORD_PUBLIC_KEY=f06d2752800024aa7d44ba00815c9a47f995cf0f3b8fc50eef9767862dffd63d
