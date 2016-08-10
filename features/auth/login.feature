Feature: Login Page
  Login page to do authenticated tasks
  As an anonymous user
  So we can protect some personal and administrative parts of the site

  @happy_path @smoke @javascript @profile
  Scenario: A user can login and see their profile
    Given I am on the login page
    And I fill in the login form with my proper username and password
    Then I should be able to see my profile page
    Then if I try to see another persons page I should get rejected

  @smoke @profile @javascript
  Scenario: A non logged in user can not get a profile
    Given I am an anonymous user
    And I go to the profile page
    Then I should get redirected with an error message to let me know the problem


