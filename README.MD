# Spirit Client (Guzzle abstract class)

## Author 
Maxim Antonisin <br>
[maxim.antonisin@gmail.com](mailto:maxim.antonisin@gmail.com) <br>
[Linkedin](https://www.linkedin.com/in/victor-berestian-bbab07a6/)


## Description
@TODO Add description.

## Requirements
- PHP 7.2+
- guzzlehttp/guzzle vendor
- symfony/http-foundation

## Using
### Alone

#### Client (Sync)

```
require_once './vendor/autoload.php';

use \Symfony\Component\HttpFoundation\Request;

$client = new MaximAntonisin\Spirit\SpiritClient([
    'base_uri' => 'json.maximus.pw',
]);

$client->sendRequest('', Request::METHOD_GET, [
    /** Request options. */
]);

/** @var array $response */
/** Response will contain json_decode-ed as array. */
$response = $client->getContent();
```

#### Client Async
```
require_once './vendor/autoload.php';

use \Symfony\Component\HttpFoundation\Request;

$client = new MaximAntonisin\Spirit\SpiritAsyncClient([
    'base_uri' => 'json.maximus.pw',
]);

/** Request #1 */
$client->addRequest(Request::METHOD_POST, '', [
    /** Request options. */
]);

/** Request #2 */
$client->addRequest(Request::METHOD_POST, '', [
    /** Request options. */
]);
$client->sendAll();

/** @var array $responses */
/** Responses will contain json_decode-ed responses as array. */
$responses = $client->getContents();
```

### Class implementation (extend)
#### Client (Sync)
```
require_once './vendor/autoload.php';

use MaximAntonisin\Spirit\SpiritClient;
use \Symfony\Component\HttpFoundation\Request;

/**
 * ... Class description ...
 *
 * @author Maxim Antonisin <maxim.antonisin@gmail.com>
 *
 * @version 1.0.0
 */
class MyClass extends SpiritClient
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
        $this->sendRequest('', Request::METHOD_GET, [
            /** Request options. */
        ]);

        /** @var array $response */
        /** Response will contain json_decode-ed as array. */
        $response = $this->getContent();
    }
}

$instance = new MyClass();
$instance->myMethod();
```

#### Client Async
```
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
```


@TODO Add all requirements.


@TODO Add more information 