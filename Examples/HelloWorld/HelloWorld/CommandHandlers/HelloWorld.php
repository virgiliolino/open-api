<?php
namespace HelloWorld\CommandHandlers;

use Dispatcher\OpenApi\CommandHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HelloWorld implements CommandHandler {
    public function execute(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $params,
        $customAttributes = []
    ) {
        $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");

	    return $response;
    }
}

