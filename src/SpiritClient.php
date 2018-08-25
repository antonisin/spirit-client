<?php

namespace MaximAntonisin\Spirit;

use Symfony\Component\HttpFoundation\Request;

/**
 * SpiritClient
 *
 * @author Maxim Antonisin <maxim.antonisin@gmail.com>
 *
 * @version 1.0.0
 */
class SpiritClient extends SpiritBaseClient
{
    /**
     * Response.
     * This property contain an response from client. Is changing for every request.
     *
     * @var mixed
     */
    private $response;

    /**
     * Content.
     * This property contain content from client response. Is changing for every request.
     *
     * @var mixed
     */
    private $content;


    /**
     * Send an request design for post service. This method changing request property for every request.
     *
     * @param string $url
     * @param string $method
     * @param array  $params
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest(string $url, string $method = Request::METHOD_GET, array $params = [])
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->response = $this->client->request($method, $url, $params);
        $response       = clone $this->response;
        $this->content  = $response->getBody()->getContents();

        /** @noinspection PhpUsageOfSilenceOperatorInspection, ReturnNullInspection */
        $content = @json_decode($this->content, true);
        if ($content) {
            $this->content = $content;
        }
    }

    /**
     * Get content from last request.
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Return last response from last request.
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
