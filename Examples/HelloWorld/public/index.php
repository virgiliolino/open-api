<?php
require 'vendor/autoload.php';
$app = new \Slim\App;
$container = $app->getContainer();
//your command Handlers need to be injected by operationId
$container['HelloWorld'] = function () {
    return new \HelloWorld\CommandHandlers\HelloWorld();
};
$openApiFile = 'routes.json';
$openApiConfigParser = Dispatcher\OpenApi\ParserFactory::parserFor($openApiFile);
$openApiConfig = $openApiConfigParser->parse($openApiFile);
\Dispatcher\OpenApi\OpenApiDispatcher::InjectRoutesFromConfig($app, $openApiConfig);
$app->run();
