# Hackaton - symfony

## Description
This project is a Symfony-based website that provides information about ski stations in the Rhone Alpes region of France. The website allows users to view information about ski tracks, lifts, and other amenities offered by various ski stations in the region.
## The team

- [Ambre Arena](https://github.com/aarena18)
- [Angel Hmeli](https://github.com/AnrelWsh)
- [Adam Ammar](https://github.com/ChampiEZ)
- [Adam Simon](https://github.com/MortyOW)
- [Fanny Gautier](https://github.com/FannyGautierr)
## Installation
1. Clone the repository
````shell
$ git clone git@github.com:FannyGautierr/hackaton-symfony.git
````
2. Go to the project directory
````shell
$ cd hackaton-symfony
$ cd skeleton
````
3. Install composer
````shell
$ composer install
````

4. Duplicate the `.env` file and name it `.env.local`
5. Update the `DATABASE_URL` variable in the `.env.local` file with your database credentials.
6. Create the database

````shell
$ php bin/console doctrine:database:create
````
7. Run the migrations
````shell
$ php bin/console doctrine:migrations:migrate
````
8. Load the fixtures
````shell
$ php bin/console doctrine:fixtures:load
````
9. Run the server
````shell 
$ symfony serve
````
10. Go to http://localhost:8000

12. Enjoy!

## Technologies Used

This project was developed using the following technologies:

- Symfony 5.4
- PHP 7.4
- Twig
- Doctrine ORM
- MySQL