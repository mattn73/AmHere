## Table of contents

[Prerequisites](#prerequisites)<br />
[Installation](#installation)<br />
[Known issues](#known-issues)<br />
[Final notes](#final-notes)<br />

# AMHERE

Application developed with Symfony 4.3

## Prerequisites

Make sure your have the following installed

- PHP 7.3
- MySQL 5.7
- NodeJS
- gulp
- php-gd
- php-zip
- php-xml
- composer (or you might want to grab the composer.phar file)

## Installation

This is a step by step of how to get the project running locally

Begin by cloning the project

    git clone git@github.com:mattn73/AmHere.git

Once the project is available locally, install the project dependencies

    composer install

Next, put your database credentials in .env file (located in the root of the project)

```
DB_NAME=amheredb
DB_USER=root
DB_PASS=${DB_USER}:root
DATABASE_URL=mysql://${DB_PASS}@127.0.0.1:3306/${DB_NAME}
HOST_NAME=http://staging.allechant.sandboxify.com # this is the website url
```

Create the database

    php bin/console doctrine:database:create

Create the database tables

    php bin/console doctrine:schema:update --force

Before running the command above, you might want to run `php bin/console doctrine:schema:update --dump-sql` to see what's happening first

## Deploying the project

To deploy the project, all codes must be pushed into the develop/release/staging environment.

For the javascript file, in your local machine 

1. For the develop and release environment, run the command below

        npm install
        npm run dev

2. For the staging environment, run the command

        npm install
        npm run build

For item number 2, this will make sure that both javascript and css files are minified.

The basics command to deploy on the server are listed below (We are using the staging as example)

```
composer install # if any depencies were added
php bin/console cache:clear -e prod # you may need to run this as root
chmod -R 775 var/ # you may need to run this as root
chown -R allechant:www-data var/ # you may need to run this as root
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force
```
As stated, these are just the basics command, you might need to run another commands if you add more bundles etc etc...

## Known issues

These are known issues we found while running the project locally

If for some reason you are having permissions issues, try the commands below

    chmod -R 775 cache/ log/
    chown <user>:www-data cache/ log/

When uploading images, the script will try to create a `uploads` folder in the public directory, due to ownership, this might fail. So create the folder manually locally and give it 777 permission

    cd public
    mkdir uploads
    chmod 777 uploads/

## Final notes

Please note that this document is subject to change in the future if any dependencies or any future changes are made inside the application.