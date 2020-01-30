## How to install

MySQL 5.7
Laravel 5.7
PHP 7.1

The project doesn't use NPM,
only PHP with some external links to CDNs (Bootstrap, jQuery)

1) Set your DB settings in .env

2) Run 
- composer dump-autoload
- php artisan migrate:fresh --seed

3) Navigate to
- localhost (for Main page)
- localhost/manager (for Admin panel)
