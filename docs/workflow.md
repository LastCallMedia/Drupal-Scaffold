Recommended Workflow
====================

We recommend the following workflow, which is already configured:

1. Developer starts work on a new feature by branching off of `master` into a new branch, `p-123`, where 123 is the ticket number. See [feature branch naming](#Feature-Branch-Naming).
2. Developer pushes work to Github on the `p-123` branch and creates a Pull Request.  As soon as the `p-123` branch is pushed to Github, it is also sent to a Pantheon multidev instance for review.
3. Pull request is reviewed and merged to master.  As soon as the `p-123` branch is deleted, the `p-123` multidev instance is destroyed.  As soon as the code is merged to master, it is deployed to the Pantheon `dev` instance for final signoff and deployment.
 
Feature Branch Naming
---------------------
All feature branches will automatically be sent to a Pantheon multidev instance. Feature branches:

* Must begin with `p-`
* Must be all lowercase (Pantheon limitation)
* Must be no more than 11 characters.
