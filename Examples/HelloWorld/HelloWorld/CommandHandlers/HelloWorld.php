<?php
namespace HelloWorld\CommandHandlers;

use Dispatcher\OpenApi\CommandHandler;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HelloWorld implements CommandHandler {
    public function execute(
        RequestInterface $request,
        ResponseInterface $response,
	    $params
    ) {
	    $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");

	    return $response;
    }
}

