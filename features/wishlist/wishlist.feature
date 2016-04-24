Feature: Setting up WishList area
    Show users withlist items but not other users
    As an logged in user
    So I can manage them but not see others


  Scenario: User visits wishlist page and sees only their wishlists
    Given I login and visit the wishlist page
    Then I should see Lorna but not see Spiderman