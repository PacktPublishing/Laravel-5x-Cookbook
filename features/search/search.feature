Feature: Search API by Name
  Search the Marvel API by Name
  As a user of the site
  So that we can then using Laravel pass this request to Marvel and back to Angular

  Scenario: Get Spider-man from the API
    Given I search for Spider-man from the API
    Then I should get results to show in the User Interface