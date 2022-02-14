# TamTam - Group-Management online

## Features
### Users management
Create various users in the application. But there is no access-management.
Every user can control the whole application / information.
Seeded user can log in with the following data : admin@tab.ch:password

### Participants management
Create various participants. Ether manually or via csv-import (from MiData, see inline description in the app).
Participants have those following attributes: Scoutname / First- & Lastname, Address, Place & PLZ, Birthday, Gender, Group & Picture
Via csv-import you are not able to add pictures.

All the participants get a unique barcode to easy get their data from the app. (And for fun....)

### Group management
You can create various groups and append participants to those. Groups have those following attributes: Name, Logo.

### Graduation control
Every participant can graduate. You can enable / disable graduations for all participants individually.

### Emergency-contact printing
Create various emergency-contacts (maximum 6). Those get printed to the back of the id-cards.
Emergency-contacts have those following attributes: Description, Number.

### Points management (per participant)
Create various point-transactions. For all participants you can add positive / negative transactions, which calculates in to a balance.
A transaction has those following attributes: Participant (select), amount of points, reason, addition / subtraction (toggle)

### Print id-cards
Print an id-card with all the Infos about the participants, with the defined emergency-contacts and the generated barcode.
Should be laminated an always be on the participant.

### Print gratulations
Export a fancy designed letter of graduation for all the participants, who passed the course (Hopefully all of them).
So you don't waste paper.... (Btw. I lied in about the fancy-part)

## Technologies
### PHP
Developed & Tested on PHP: 7.4

### Laravel
Based on Laravel-Framework Version: 8

### Yarn
User Yarn to compile Assets in Version: 1.22

## Setup
### Webserver
Best use Apache or Nginx as Webserver. Surely with PHP module or FPM | FCGI.
You'll have to set the document root into the dir `./public`.

### Composer installation
Now install all the composer-libraries with the command `composer install` or `php composer.phar install`.
See here how to install composer: https://getcomposer.org/

### DB Migration
If the app is set up, you have to create a db by now. Enter the configuration to the .env or add them to the server ENV.
If the configuration is done, run the following command: `php artisan migrate`

### DB Seeding
When migration is done, let the DB be seeded: `php artisan db:seed`

### Have fun... 
