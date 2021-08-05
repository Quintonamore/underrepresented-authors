# underrepresented-authors

## Website
Our website directory contains the database export, and associated php files.

### Running with Docker
The website can be ran with docker and docker-compose. First make sure both are [installed](https://docs.docker.com/get-docker/).

From there, we can run the following to start the services needed to serve the website. This will spin up three separate services for the website.
```
$ docker-compose up
```

1. web: This service is an apache server that is configured to serve all files in websiteFolder/kioni. Accessible through localhost/home.php
2. db: This is our mysql database.
3. admin: Phpmyadmin server for ease of development with the database. Accessible through localhost:8000