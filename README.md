## Demo

http://www.tet.kilograms.lv


## Install

- get project ```git clone https://github.com/agrism/tet-test.git```
- copy env file: ```cp .env.example .env```
- write db credentials in .env file
- run: ```composer install```
- run: ```php artisan key:generate```
- run: ```php artisan migrate```
- run: ```npm install```
- run: ```npm run prod```
- entry point ```public/index.php```
- run: ```crontab -e```
- add line: ```0 * * * * cd /path-to-project && php artisan currency:read >> /var/log/cron.log 2>&1```


## Requirements

- MySql 5.6 >
- PHP >= 8.1
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
