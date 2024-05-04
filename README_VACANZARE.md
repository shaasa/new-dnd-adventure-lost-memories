## Per cominciare

### **ATTENZIONE** È necessario almeno NODEJS >=20.x
#### **ATTENZIONE** in produzione sul plesk DISABILITARE Node.js dall'interfaccia e lanciarlo solo da ssh

1. ``` composer install ```
2. ``` npm install ```
3. Creare il file .env
4. Creare un db e configurare adeguatamente il file .env
5. ```php artisan key:generate```
6. ```php artisan migrate```
7. ```php artisan db:seed``` Aggiunti i personaggi come utenti
8. ```php artisan serve``` per far partire il server in locale
9. ```php artisan install:broadcasting``` per installare Reverbe
10. ```npm run dev``` o ```npm run build``` in produzione per far partire VITE https://laravel.com/docs/11.x/vite#running-vite
11. ```php artisan reverb:start``` per far partire Reverbe
