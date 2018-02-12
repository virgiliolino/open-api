<?php
require 'vendor/autoload.php';
$app = new \Slim\App;
$container = $app->getContainer();
//your command Handlers need to be injected by operationId
$container['HelloWorld'] = function () {
    return new \HelloWorld\CommandHandlers\HelloWorld();
};
$swaggerApiFile = 'routes.json';
$swaggerConfigParser = Dispatcher\Swagger\ParserFactory::parserFor($swaggerApiFile);
$swaggerConfig = $swaggerConfigParser->parse($swaggerApiFile);
\Dispatcher\Swagger\SwaggerDispatcher::InjectRoutesFromConfig($app, $swaggerConfig); 
$app->run();
