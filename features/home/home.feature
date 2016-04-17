Feature: Review of Home Page using BDD
  why
  who
  what

  Scenario: User Visits home page and searches
    Given I am on the homepage
    Then I will see a search bar
    And I add the search term "Spider-Man" and search
    Then I will see lots and lots of comics and images