Varnish
-------

[Varnish](https://varnish-cache.org/) is an HTTTP reverse proxy cache that stores cached pages "at the edge".  Many hosts (Pantheon, Acquia) use it as part of their platform.  Varnish sits in front of Apache and PHP, so when you visit the site, the first server you hit is the Varnish server, which passes requests back to Apache if it is not able to serve a page from the cache.

Configuration
-------------
Varnish configuration (VCL) is stored in [default.vcl](/docker/default.vcl).

Running
-------
To use Varnish:
 
1. Uncomment the `varnish` container in [`docker-compose.yml`](/docker-compose.yml).  
2. Run `docker-compose up -d varnish` to bring the Varnish container up.
3. Visit the site on port 8085 instead of 8080.
