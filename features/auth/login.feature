@javascript
Feature: Login Page
  Login page to do authenticated tasks
  As an anonymous user
  So we can protect some person and administrative parts of the site

  @happy_path
  Scenario: A user can login and see their profile
    Given I am on the login page
    And I fill in the login form with my proper username and password
    Then I should be able to see my profile page
    Then when I logout and revisit that profile page I will be redirected to the login page