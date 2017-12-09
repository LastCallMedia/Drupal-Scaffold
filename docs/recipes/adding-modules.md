Adding Modules/Themes
---------------------
Use composer to bring in modules and themes.  For example, if you want to add the [metatag](https://www.drupal.org/project/metatag) module, you would use the following workflow:

1. Add the module using composer:
    ```bash
    # from inside drupal container:
    composer require drupal/metatag
    ```
2. Enable the module:
    ```bash
    # from inside drupal container:
    drush en metatag
    ```
3. Export the configuration that includes the metatag module:
    ```bash
    drush config-export -y
    ```
4. Review and commit configuration changes:
    ```bash
    # from your host machine:
    git status config/ # review changes, make sure there is nothing unexpected
    # finalize the changes by committing them.
    git add config/
    git commit -m "Enabling metatag module"
    ```
