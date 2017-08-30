#
# Drush Test
#
# This is an example of a Behat feature that does not use the web driver. It executes a
# Drush command and checks that it was successful.  This serves as a good baseline check
# for whether the current site has any critical configuration errors.
@drush
Feature: I should be able to use Drush

  Scenario: Drush should exist
    When I run drush "st" "--pipe"
    Then drush output should contain '"bootstrap": "Successful"'
