<?php
namespace HelloWorld\CommandHandlers;

class HelloWorld {
    public static function execute(
        \Slim\Http\Request $request, 
        \Slim\Http\Response $response, 
	$params
    ) {
	 $name = $request->getAttribute('name');
	 $response->getBody()->write("Hello, $name");

	 return $response;
    }
}

