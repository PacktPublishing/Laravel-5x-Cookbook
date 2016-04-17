Feature: Testing
  @mink:goutte
  Scenario: Testing Wiki
    Given I am on "/wiki/Main_Page"
    And I wait
    Then I should see "Wiki"