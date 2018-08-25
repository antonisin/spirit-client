<?php

namespace MaximAntonisin\Spirit;

use GuzzleHttp\Psr7\Response;

/**
 * SpiritAsyncClient
 *
 * @author Maxim Antonisin <maxim.antonisin@gmail.com>
 *
 * @version 1.0.0
 */
class SpiritAsyncClient extends SpiritBaseClient
{
    const DEFAULT_PARAMS = [
        'connect_timeout' => 5,
        'timeout'         => 5,
        'http_errors'     => false,
    ];


    private $responses = [];
    private $contents  = [];

    /**
     * Add request to stack.
     * This method is designed to add new requests to stack.
     *
     * @param string $method - HTTP request method
     * @param string $url    - Path/url
     * @param array  $params - Request/guzzle params
     *
     * @return self
     */
    public function addRequest(string $method = 'GET', string $url = '', array $params = []):self
    {
        $params = array_merge(SpiritAsyncClient::DEFAULT_PARAMS, $params);

        $this->responses[] = $this->client->requestAsync($method, $url, $params);

        return $this;
    }

    /**
     * Send all stacked requests.
     * This method is designed to send all requests from stack. This method may receive argument $keepError. If this
     * argument is true, all invalid requests will be keeped in request stack. If this argument is false, this method
     * will remove all requests with error.
     *
     * @param bool $keepError
     *
     * @return self
     */
    public function sendAll(bool $keepError = false):self
    {
        foreach ($this->responses as $index => $promise) {
            try {
                /** @var Response $response */
                $response = $promise->wait();
                $content  = $response->getBody()->getContents();

                $this->responses[$index] = clone $response;
                $this->contents[$index]  = $content;

                /** Check if response content may be decoded. */
                /** @noinspection PhpUsageOfSilenceOperatorInspection, ReturnNullInspection */
                $content = @json_decode($content, true);
                if ($content) {
                    $this->contents[$index] = $content;
                }
            } catch (\Exception $exception) {
                if (true === $keepError) {
                    unset($this->responses[$index]);
                }
            }
        }

        return $this;
    }

    /**
     * Return array of responses Instances.
     *
     * @return array
     */
    public function getResponses():array
    {
        return $this->responses;
    }

    /**
     * Return array of responses's content.
     *
     * @return array
     */
    public function getContents():array
    {
        return $this->contents;
    }
}
