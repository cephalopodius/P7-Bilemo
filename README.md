
# Used version for this project
* Symfony 4.2
* WampServer 3.2.7
    * Apache 2.4.41
    * PHP 7.3.12
    * MySQL 5.7.24 (5.7.8 minimum : column JSON used)

# API information
* To get the required tolken to connnect at the API go to /api/login_check.
* "Get" method can be used by all logged users
* Only ROLE_ADMIN granted user can access the POST/DELETE methode.

# Installation

1. Set your environment variable as the database's connection in the .env file at the root's project.

2. Download and install the project's Dependencies with the following Composer's command :
```
    composer install
```
3. Create the database's project with the following command :
```
    php bin/console doctrine:database:create
```
4. Make the differente database's table with migrations. Here is the command :
```
    php bin/console doctrine:migrations:migrate
```
5. Generate SSH key. Passphrase is in the .env file at the line  "JWT_PASSPHRASE="
here is usefull command for it :
```
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```
6. You can install some demo data using the existing fixtures with the following command :
```
    php bin/console doctrine:fixtures:load
```
Job's done, ready to work !
