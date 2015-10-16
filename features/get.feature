Feature: Get
  Get entry from backend
  run bin/behat

  Scenario Outline:
    Given I am on URI "<url>"
    And I set the "Content-Type" header to be "application/json"
    When I request "GET <path>"
    Then the response status code should be "<statuscode>"
    And the content type should be "application/json"
    And the "X-Version" header should be " "

    Examples:
      | url            | path | statuscode |
      | localhost:8000 |      | 200        |
