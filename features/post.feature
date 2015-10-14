Feature: Post
  POST a new entry to backend
  run bin/behat

  Scenario:
    Given I have the payload:
    """
    """
    And I am on URI " "
    And I set the "Content-Type" header to be "application/json"
    When I request "POST /path/"
    Then the response status code should be 201
    And the content type should be "application/json"
    And the "X-Version" header should be " "
    And the payload should be:
    """
    """