## Sample project 
Symfony 5.2.1 with Docker php 8.0.1, nginx and mysql.

## After installation
Execute following commands in jc-php

* Create tables ```bin/console doctrine:migrations:migrate```
* Load Fixtures ```bin/console doctrine:fixtures:load```

There will be 10 users set up ready to login

| username | password |
|----------|----------|
| scayla0  | symfony0 |
| scayla1  | symfony1 |
| scayla2  | symfony2 |
| ...      | ...      |
| scayla9  | symfony9 |

## For development
* Checkout project.
* Enter the directory symfony
* Execute `composer install --ignore-platform-reqs` ( No need to check if you have all required php installed )
* Return to main project folder and run: `docker-compose up -d --build`
* Go to "localhost" on your browser.

If you wish to stop docker, run: `docker-compose down`, later you can start it with just `docker-compose up -d`

If you have locally mysql installed you can disable docker mysql for starting in docker-compose yml
 file and just set the configuration so symfony can use that DB.
  
If you have another web server running localhost Docker will map the output port to nginx that's free.
Check that running `docker ps`, you should see something like:

0.0.0.0:80  is your host address and port. 

If you wanna login to the php container to use phpunit or php commands:
```bash
docker exec -ti jc-php bash
```
To exit, `exit` 
