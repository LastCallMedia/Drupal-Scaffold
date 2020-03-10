Docker
======

[Lando](https://docs.lando.dev/) is an local development platform for developers. It is software that lives on your local machine that allows you to run preconfigured development environments without extensive configuration.

Installing
----------
You must have `lando` installed on your local machine before using the Lando environments.  

Installers for Windows, Mac, and various Linux distributions can be found on the [releases page](https://github.com/lando/lando/releases). Generally the newest release available is preferred. 

Configuration
-------------
All Docker configuration for this project lives in the [`.lando.yml`](/.lando.yml) file in the repository root. You may customize this file to suit the needs of the project.

Running
-------
Use the `lando` command on your host to interact with Lando.

* Start all containers: `docker-compose start`
* View lando service info: `lando info`
* Stop all containers: `lando stop`
* Rebuild all services: `lando rebuild`
* Output the logs of the `lando` services: `lando logs`, `lando logs -s appserver`
* Remove all containers to reset your environment: `lando destroy`

Accessing the Containers
------------------------
When the containers are running, they are accessible on the following ports:

* **8080**: Direct connection to Drupal running on Apache.
* **33306**: Direct connection to MySQL.  Useful for connecting to the database from the host machine.  A direct mysql connection can be made from the outside via: `mysql -h 127.0.0.1 --port 33306 -u drupal -pdrupal drupal`

Optional containers (must be enabled before you can use them):
* **8085**: Varnish, connected to Drupal.  If you want to use Varnish, uncomment it in `docker-compose.yml`
* **8983**: Solr direct connection.  Useful for debugging via Apache Solr web interface.

Important: Should you choose to run this setup in production, you should always remove the debug ports (noted in `docker-compose.yml`) for security.

Troubleshooting
---------------
* If you see an error message bringing up the containers that has something like "port is already allocated", it means that another application is already using one of the ports.  You can set alternate ports in `.env` (see [Confguration](#Configuration)).
