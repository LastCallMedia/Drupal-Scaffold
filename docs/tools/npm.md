NPM/Yarn
--------

Node Package Manager(npm) is a package management tool for NodeJS packages.  Yarn is a newer, faster tool that does the same thing.  NPM and Yarn are both installed in the `node` service of the Lando local development environment.

Configuration
-------------
NodeJS packages are configured through [`package.json`](/package.json). Documentation for `package.json` is available [here](https://docs.npmjs.com/files/package.json), but keep in mind that you are using NPM to manage dependencies, not to publish packages to NPM, so several features do not apply to your project (eg: the `files` section).

Running
-------
Use `yarn` rather than `npm` - these two commands are equivalent, but `yarn` is faster, and the CircleCI build relies on a `yarn.lock` file that gets generated when you use `yarn`.

* Install all dependencies: `lando yarn install`
* Update dependencies to the latest versions: `lando yarn upgrade`
* List outdated dependencies: `lando yarn outdated`
* Add a new dependency: `lando yarn add mypackage`.  This will add the package to `package.json` and install it right away.

Enabling NPM
------------
By default, `npm` is disabled in the local Lando development. This is done because it can create confusion if some people use `npm` while others use `yarn`. Yarn will complain if it sees a `package-lock.json` file as well.

To enable the use of `npm`, remove npm tooling override in the `tooling` section of `.lando.yml` in the project root.
You are also able to use `npm` by `ssh`ing into the `node` service (`lando ssh -s node`) 
