Feature: Review of Home Page using BDD
  why So users can search the home page
  who any user
  what this adds key value to the site

  Scenario: User Visits home page and searches
    Given I am on the homepage
    Then I will see a search bar
    And I add the search term "Spider-Man" and search
    Then I will see lots and lots of comics and images