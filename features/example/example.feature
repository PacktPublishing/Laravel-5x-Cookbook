@javascript
Feature: Two sites but one test

  Scenario: I go to site and see something
    Given I setup language
    Given I visit the home page
    Then I should see the text welcome text