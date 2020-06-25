<?php

require_once './vendor/autoload.php';

use MaximAntonisin\Spirit\SpiritAsyncClient;
use \Symfony\Component\HttpFoundation\Request;

/**
 * ... Class description ...
 *
 * @author Maxim Antonisin <maxim.antonisin@gmail.com>
 *
 * @version 1.0.0
 */
class MyAsyncClass extends SpiritAsyncClient
{
    /**
     * {@inheridDoc}
     */
    protected $baseUrl = 'json.maximus.pw';

    /**
     * ... Method description ...
     */
    public function myMethod()
    {
        /** Request #1 */
        $this->addRequest(Request::METHOD_POST, '', [
            /** Request options. */
        ]);

        /** Request #2 */
        $this->addRequest(Request::METHOD_POST, '', [
            /** Request options. */
        ]);
        $this->sendAll();

        /** @var array $responses */
        /** Responses will contain json_decode-ed responses as array. */
        $responses = $this->getContents();
    }
}

$instance = new MyAsyncClass();
$instance->myMethod();



//use \Symfony\Component\HttpFoundation\Request;
//
//$client = new MaximAntonisin\Spirit\SpiritAsyncClient([
//    'base_uri' => 'json.maximus.pw',
//]);
//
///** Request #1 */
//$client->addRequest(Request::METHOD_POST, '', [
//    /** Request options. */
//]);
//
///** Request #2 */
//$client->addRequest(Request::METHOD_POST, '', [
//    /** Request options. */
//]);
//$client->sendAll();
//
///** @var array $responses */
///** Responses will contain json_decode-ed responses as array. */
//$responses = $client->getContents();
//
//var_dump($responses);
