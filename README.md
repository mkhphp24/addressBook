
Installation (AdressBook - symfony + SQlite):
=====================

1- Download Package 

2- composer install

3- Configure  database 

 - php bin/console doctrine:database:create
 - php bin/console d:mig:mig
 
4- load fixtures:

 - php bin/console doctrine:fixtures:load

5- symfony server:start
 
 After this, visit [http://127.0.0.1:8000](http://127.0.0.1:8000).

Testing
=====================
 php bin/phpunit tests/


