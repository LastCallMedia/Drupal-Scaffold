TODO
====

- [ ] BLACKFIRE: Enable Blackfire in Lando (see [this issue](https://github.com/lando/lando/issues/511) and [this gist](https://gist.github.com/tylerssn/8923149702d4a796c5e103412c2370c3))
    - Update Blackfire docs in docs/tools/blackfire.md
- [x] WDIO:
    - Disable, remove WDIO configuration
    - Documentation at docs/tools/wdio.md
- [ ] MANNEQUIN: 
    - Add mannequin service to Lando config 
    - Update Mannequin docs at docs/tools/mannequin.md
- [x] VARNISH:
    - Determine if we still want a varnish service
    - [ ] If yes:
        - add varnish service to .lando.yml 
    - [x] If no:
        - Remove docker/default.vcl, docs in docs/tools/varnish.md
- [ ] DOCKER-COMPOSE: Since we're switching from docker-compose to lando it would be confusing to leave the docker-compose functionality in here, documented or not. We should remove config and references to the old docker-compose local infrastructure  
    - Remove `docker-compose.yml`
    - Remove `docker` directory 
- [ ] LOCAL DEVELOPMENT TOOLS:
    - Determine if we need the `site-import` tooling in `appserver`
    - If yes:
        - Add terminus commands and scripts for importing a database
        - Add acquia API commands for importing databases
