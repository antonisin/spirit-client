<?php

namespace MaximAntonisin\Spirit;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

/**
 * SpiritBaseClient
 *
 * @author Maxim Antonisin <maxim.antonisin@gmail.com>
 *
 * @version 1.0.0
 */
class SpiritBaseClient
{
    /**
     * Client instance.
     * This property contain an client instance with all necessary param and data. Is used to send an request to
     * post service and get an response.
     *
     * @var Client
     */
    protected $client;

    /**
     * Cookies.
     * This property contain an instance of cookie class. It need to store cookies, sessions and something more if
     * needed.
     *
     * @var CookieJar
     */
    protected $cookie;

    /**
     * URL.
     * This property contain post service base url.
     *
     * @var string
     */
    protected $baseUrl;


    /**
     * SpiritBaseClient constructor.
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
     *
     * @return self
     */
    public function reInitClient($url = null):self
    {
        $params = [
            'base_uri' => $url ?? $this->baseUrl,
            'cookies'  => $this->cookie,
        ];
        $this->client = new Client($params);

        return $this;
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
}
