Feature: Sign in to the website
  In order to access the administrative interface
  As a visitor
  I need to be able to log in to the website

  @javascript
  Scenario: Log in with username and password
    Given I am on "/#!/login/"
    When I fill in the following:
      | username | foo |
      | password | bar |
    And I press "submit"
    Then I should be on "/#!/"
    And I should see " "

  @javascript
  Scenario: Log in with bad credentials
    Given I am on "/#!/login/"
    When I fill in the following:
      | username | bar@foo.com |
      | password | bar         |
    And I press "submit"
    Then I should be on "/#!/login/"