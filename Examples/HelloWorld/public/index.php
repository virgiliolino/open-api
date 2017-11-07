<?php
require 'vendor/autoload.php';
$app = new \Slim\App;
$container['HelloWorld'] = function ($c) {
    return new \HelloWorld\CommandHandlers\HelloWorld();
};
$swaggerApiFile = 'routes.json';
$swaggerConfigParser = Dispatcher\Swagger\ParserFactory::parserFor($swaggerApiFile);
$swaggerConfig = $swaggerConfigParser->parse($swaggerApiFile);
\Dispatcher\Swagger\SwaggerDispatcher::InjectRoutesFromConfig($app, $swaggerConfig); 
$app->run();
