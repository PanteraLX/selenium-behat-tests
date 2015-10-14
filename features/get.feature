Feature: Get
  Get entry from backend
  run bin/behat

  Scenario:
    Given I am on URI " "
    And I set the "Content-Type" header to be "application/json"
    When I request "GET /path/"
    Then the response status code should be 200
    And the content type should be "application/json"
    And the "X-Version" header should be " "