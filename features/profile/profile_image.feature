@javascript
Feature: User can upload image to profile
  Can upload an image to their profile
  Any authenticated user
  So the site will have a sense of community

  @cleanup_user_profile
  Scenario: Can upload image to profile page edit page
    Given I am on the page to edit my profile
    Then I should be able to upload an image file
    And then see it on my profile view page

  Scenario: Dealing with edge cases
    Given I upload a non jpg file I should get an error message
    Given I upload a file that is too large I should get an error message