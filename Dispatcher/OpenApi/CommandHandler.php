<?php
namespace Dispatcher\OpenApi;

use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

interface CommandHandler {
    public function execute(
        String $operationId,
        RequestInterface $request,
        ResponseInterface $response,
        $params,
        $customAttributes = []
    );
}

