<?php
use Behat\Behat\Exception\PendingException;
use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode;
use Guzzle\Http\Client;

/**
 * Defines application features from the specific context.
 */
class ApiFeatureContext extends BehatContext
{
    /**
     * @var $request
     */
    protected $request;
    /**
     * @var PyStringNode $requestPayload
     */
    protected $requestPayload;
    /**
     * @var PyStringNode $responsePayload
     */
    protected $responsePayload;
    /**
     * Guzzle HTTP-Client
     *
     * @var Client $client
     */
    protected $client;
    /**
     * The current resource
     *
     * @var $resource
     */
    protected $resource;
    /**
     * The current response
     *
     * @var $response
     */
    protected $response;
    /**
     * @var $httpMethod
     */
    protected $httpMethod;
    /**
     * @var $uri
     */
    protected $uri;
    /**
     * @var array
     */
    protected $headers;

    /**
     * Construct
     */
    public function __construct()
    {
    }

    /**
    * @Given /^I am using a "([^"]*)"-request/
     *
     * @param $httpMethod
     */
    public function iAmUsing($httpMethod)
    {
        $this->$httpMethod = $httpMethod;
    }

    /**
     * @Given /^I am on URI "([^"]*)"$/
     *
     * @param $uri
     */
    public function iAmOnUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @Given /^I have the payload:$/
     *
     * @param PyStringNode $requestPayload
     */
    public function iHaveThePayload(PyStringNode $requestPayload)
    {
        $this->requestPayload = $requestPayload;
    }

    /**
     * @Given /^I set the "([^"]*)" header to be "([^"]*)"$/
     *
     * @param $headerName
     * @param $value
     */
    public function iSetTheHeaderToBe($headerName, $value)
    {
        $this->headers[$headerName] = $value;
    }

    /**
     * @When /^I request "([^"]*)"$/
     *
     * @param $resource
     */
    public function iRequest($resource)
    {
        $this->client = new Client();
        $resource = $this->uri . $resource;
        switch (strtoupper($this->httpMethod)) {
            default:
                $this->response = $this->client
                    ->get($resource)
                    ->send();
                break;
            case 'POST':
                $postBody = $this->requestPayload->getRaw();
                $this->response = $this->client
                    ->post($resource, $this->headers, $postBody)
                    ->send();
                break;
            case 'PUT':
                $this->response = $this->client
                    ->put($resource)
                    ->send();
                break;
            case 'DELETE':
                $this->response = $this->client
                    ->delete($resource)
                    ->send();
                break;
                break;
        }
    }

    /**
     * @Then /^the response status code should be "([^"]*)"$/
     *
     * @param $expectedStatusCode
     */
    public function theResponseStatusCodeShouldBe($expectedStatusCode)
    {
        $statusCode = $this->response->getStatusCode();
        \PHPUnit_Framework_Assert::assertSame((int) $expectedStatusCode, (int) $statusCode);
    }

    /**
     * @Then /^the content type should be "([^"]*)"$/
     *
     * @param $expectedContentType
     */
    public function theContentTypeShouldBe($expectedContentType)
    {
        $contentTypeArray = explode(';',$this->response->getContentType());
        \PHPUnit_Framework_Assert::assertSame($expectedContentType, $contentTypeArray[0]);
    }

    /**
     * @Then /^the "([^"]*)" header should be "([^"]*)"$/
     *
     * @param $headerName
     * @param $expectedHeaderValue
     * @throws PendingException
     */
    public function theHeaderShouldBe($headerName, $expectedHeaderValue)
    {
        $headerValue = $this->response->getHeader($headerName)->raw()[0];
        var_dump($headerValue);
        \PHPUnit_Framework_Assert::assertSame($expectedHeaderValue, $headerValue);
    }

    /**
     * @Then the payload should be:
     *
     * @param PyStringNode $responsePayload
     * @throws PendingException
     */
    public function thePayloadShouldBe (PyStringNode $responsePayload)
    {
        $this->responsePayload = $responsePayload;
        throw new PendingException();
    }

    /**
     * Checks the response exists and returns it.
     *
     * @return  Guzzle\Http\Message\Response
     * @throws Exception
     */
    protected function getResponse()
    {
        if (! $this->response) {
            throw new Exception("You must first make a request to check a response.");
        }
        return $this->response;
    }
}
