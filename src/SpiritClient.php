<?php

namespace MaximAntonisin\Spirit;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Symfony\Component\HttpFoundation\Request;

/**
 * SpiritClient
 *
 * @author Maxim Antonisin <maxim.antonisin@gmail.com>
 * @version 1.0.0
 */
class SpiritClient
{
    /**
     * Client instance.
     * This property contain an client instance with all neccesary param and data. Is used to send an request to
     * post service and get an response.
     *
     * @var Client
     */
    private $client;

    /**
     * Cookies.
     * This property contain an instance of cookie class. It need to store cookies, sessions and something more if
     * needed.
     *
     * @var CookieJar
     */
    private $cookie;

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
     * URL.
     * This property contain post service base url.
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->cookie = new CookieJar();

        if ($this->baseUrl) {
            $params = [
                'base_uri' => $this->baseUrl,
                'cookies'  => $this->cookie,
            ];
            $this->client = new Client($params);
        }
    }

    /**
     * Re-init client instance.
     * This method is designed to re initialize client instance with new url.
     *
     * @param string|null $url
     */
    public function reInitClient($url = null)
    {
        $params = [
            'base_uri' => $url ?? $this->baseUrl,
            'cookies'  => $this->cookie,
        ];
        $this->client = new Client($params);
    }

    /**
     * Return client instance.
     * This method will return an instance of client used to send and work with post service.
     *
     * @return Client
     */
    public function getClient():Client
    {
        return $this->client;
    }

    /**
     * Set client instance.
     * This method will set an instance of client used to send and work with post service.
     *
     * @param Client $client
     *
     * @return self
     */
    public function setClient(Client $client):self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Return cookie jar.
     * Return an instance of cookie class. It need to store cookies, sessions and something more if needed.
     *
     * @return CookieJar
     */
    public function getCookie():CookieJar
    {
        return $this->cookie;
    }

    /**
     * Set cookie jar.
     * Set instance of cookie class. It need to store cookies, sessions and something more if needed.
     *
     * @param CookieJar $cookie
     *
     * @return self
     */
    public function setCookie(CookieJar $cookie):self
    {
        $this->cookie = $cookie;

        return $this;
    }

    /**
     * Send an request design for post service. This method changing request property for every request.
     *
     * @param string $url
     * @param string $method
     * @param array  $params
     */
    public function sendRequest(string $url, string $method = Request::METHOD_GET, array $params = [])
    {
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