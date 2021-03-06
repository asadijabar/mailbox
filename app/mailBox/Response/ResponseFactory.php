<?php

namespace App\APM\Response;


use App\mailBox\Exceptions\MessageRuntimeException;
use Exception;

class ResponseFactory
{

    /** @var string strategies namespace  */
    const STRATEGIES_PREFIX = 'App\mailBox\Response\Strategy\Response';

    /** @var  ResponseFactory */
    private static $instance;

    /**
     * ResponseFactory constructor.
     */
    private function __construct()
    {
    }

    /**
     * singleton instantiate
     * @return ResponseFactory
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new ResponseFactory();
        }

        return self::$instance;
    }


    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function create($data = array())
    {
        $resourceType = ucfirst($data['requestType']);
        $class = self::STRATEGIES_PREFIX . $resourceType;

        try {
            // load strategy based on different request types
            $strategy = new $class();
            $response = $strategy->handle($data);
            return $this->response($response);

        } catch (MessageRuntimeException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }


    /**
     * return message block to client if necessary
     * @param $response
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function response($response)
    {
        $message = array(
            'data' => $response->getData(),
            'errors' => $response->getError(),
            'meta' => $response->meta()
        );

        return response($message, $response->getStatus(), array(
            'Content-Type' => 'application/json'
        ));

    }

}
