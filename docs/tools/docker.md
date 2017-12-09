Docker
======

[Docker](https://docs.docker.com/) is an open platform for developers and sysadmins to build, ship, and run distributed applications. In this project, it is software that lives on your local machine that allows you to run preconfigured development environments without extensive configuration. Specifically, this project uses [Docker Compose](https://docs.docker.com/compose/) to define and run the local development environment.

Installing
----------
You must have `docker` and `docker-compose` installed on your local machine before using the Docker environments.  

[Mac](https://docs.docker.com/docker-for-mac/install/) | [Windows](https://docs.docker.com/docker-for-windows/install/)

Configuration
-------------
All Docker configuration for this project lives in the [`docker-compose.yml`](/docker-compose.yml) file in the repository root. You may customize this file if you would like, or you may use the following files to customize your environment further:

* [`docker/drupal.env`](/docker/drupal.env) - This file contains environment variables that are injected into the `drupal` container. It should be committed to the repository, so do not put anything sensitive in here.
* `.env` - This file can contain environment variables that get referenced in `docker-compose.yml`.  See [`.env.example`](/.env.example) for documentation on variables may be used.

For port configuration, changing the "exposed" port does not change the port inside of the container.  Eg: If you change the `MANNEQUIN_PORT` variable to 8007, you should still run Mannequin inside of the container on 8081, but you will access it from your browser at `localhost:8007`.

Running
-------
Use the `docker-compose` command on your host to interact with Docker.

* Start all containers: `docker-compose up -d`
* List running containers: `docker-compose ps`
* Stop all containers: `docker-compose stop`
* Download updates to all containers: `docker-compose pull`
* Output the logs of the `drupal` container: `docker-compose logs drupal`
* Remove all containers to reset your environment: `docker-compose down`

Note that MySQL data will not be removed, even when you remove the `mysql` container.  To fully delete this data, use `docker-compose down -v`.

Troubleshooting
---------------
* If you see an error message bringing up the containers that has something like "port is already allocated", it means that another application is already using one of the ports.  You can set alternate ports in `.env` (see [Confguration](#Configuration)).
