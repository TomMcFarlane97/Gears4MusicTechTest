# Gears4MusicTechTest
Gears 4 music tech test

Please note, this is an idea of how I would code, and I have obviously generated the data myself and not got the 
data from the database.

Requirements to run this tech test
- php 7.4
- composer
- Command Line Interface

##How it is built
- [Slim framework](http://www.slimframework.com/docs/v4/) version 4
- [Symfony Console](https://symfony.com/doc/current/components/console.html) - 5.1

###Tom McFarlane's Tech Test
It is running off the local php server. 
To run the server, `php -S localhost:8000 public/index.php`
All the requests come through `public/index.php`

To see the console commands in the terminal please type `php bin/command.php`
To start a new batch `php bin/command.php batch:start`
To end a batch `php bin/command.php batch:end`
To see how to create a new Consignment please view `public/endpoints.md` - please note, I would have done this in Swagger
To run tests, use `php ./vendor/bin/phpunit tests/unit`

###General Comments
I think it is self-explanatory how I have set up the project and every single Class has its own function.
It is all split out into their own directories with relevant naming.
The idea behind the commands was to have them run as cron scripts on the server at a set time of when the batches
should start/end which will save a human having to start and end them. To create a new consignment you will need to 
the `public/endpoints.md` file.

###Just to give an overview
- bin - console commands are instantiated here
- data - none relevant data that can be deleted.
- public - anything that is public facing
- src - all logic and code belongs here
- tests - all tests are here
- vendor - all composer and third party dependencies

#####Inside src directory
- Commands - all console commands are wrote
- Controllers - all the endpoints are configured to accept data from a request and to then return a response
- Entities - map of the database tables
- Exceptions - custom exceptions  to give a better knowledge of what is going
- Factories - design patterns
- Interfaces - where all the contracts are added
- Repositories - The section that communicates with the Database
- Services - Where all business logic is handled

Please note for the API side, I would have added in switching of data, e.g. if passed an XML request, then I would have
returned XML, the same with validating a bearer token, ensuring it came from the right IP address as well.
The same for the unit tests. I only wrote tests for one Command just to demonstrate the point that I can do it.
