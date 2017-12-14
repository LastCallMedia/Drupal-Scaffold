Composer Upstream Files
=======================

[Composer Upstream Files](https://github.com/LastCallMedia/Composer-Upstream-Files) is a Composer command that is used to update the Scaffold files for projects that have already been started.

**Important**: Review all changes to upstream files carefully before committing.  Out of the box, all scaffold files are updated.  At that point, you will need to review the changes to things like `package.json` and merge your changes with how this file has changed upstream.  You may also want to exclude yourself from updates to certain files in the future.  See the documentation for how to do that. 

Configuration
-------------
The config for upstream files lives in [`composer.json`](/composer.json) under the `extra` key.  See [this page](https://github.com/LastCallMedia/Composer-Upstream-Files/blob/master/README.md) for more information on how to configure it. 

Running
-------
* `composer upstream-files:update`: Pull in the most recent versions of all quasi-core and scaffold files. 
* `composer upstream-files:list`: Show a list of all files that will be updated.



