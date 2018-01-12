<?php
namespace Dispatcher\Swagger;

use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

interface CommandHandler {
    public function execute(RequestInterface $request, ResponseInterface $response, $params);
}

