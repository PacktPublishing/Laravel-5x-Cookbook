@javascript
Feature: Search using Angular from the Home page
  Searching Marvel using Angular
  As a user on the sight
  So the results are fast

  Scenario: Search for Wolverine
    Given I am on the homepage
    And I search for "Wolverine"
    Then I should see a ton of results about him
    And if I click the Next in the Pagination I can see even more "Wolverines (2015) #5"