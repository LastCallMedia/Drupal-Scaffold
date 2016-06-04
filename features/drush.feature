@drush
Feature: I should be able to use Drush

  Scenario: Drush should exist
    When I run drush "st" "--pipe"
    Then drush output should contain '"bootstrap": "Successful"'
