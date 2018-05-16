# Symfony 4 API
The service will provide functionality to create, read, update and delete certain entities, namely: Company, Employee, Dependant.
Companies can have multiple employees and employees can have multiple dependants.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Symfony 4 Prerequisites
To create your new Symfony application, first make sure you're using PHP 7.1 or higher and have Composer installed.

### Installing

1- clone the project/reposiory on your machine
```
git clone https://github.com/samernajj/symfony4.git
```

2- go to the project
```
cd symfony4
```
3- composer update to install dependencies 
```
composer install
```

4- set the configuration for our data base in the configuration file .env by changing the db_name the user and the password
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

5- create database
```
bin/console doctrine:database:create
```

6- create database schema 
```
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```
7- run the application
```
php -S 127.0.0.1:8000 -t public
```
## Built With

* [Symfony 4](https://symfony.com/) - PHP MVC framework
* [Composer](https://getcomposer.org/) - Dependency Management


## Author

* **Samer Najjar** - [samernajj](https://github.com/samernajj)
