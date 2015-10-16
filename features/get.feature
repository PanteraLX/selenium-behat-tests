Feature: Get
  Get entry from backend
  run bin/behat

  Scenario Outline:
    Given I am on URI "<url>"
    And I set the "Content-Type" header to be "application/json"
    And I am using a "GET"-request
    When I request "<path>"
    Then the response status code should be "<statuscode>"
    And the content type should be "application/json"
    And the " " header should be " "

    Examples:
      | url                   | path    | statuscode |
      | http://localhost:8000 |         | 200        |
      | http://localhost:8000 |         | 200        |
