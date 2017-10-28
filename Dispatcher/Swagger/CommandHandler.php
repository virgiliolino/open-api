<?php
namespace Dispatcher\Swagger;

interface CommandHandler {

    public static function execute(
        \Slim\Http\Request $request,
        \Slim\Http\Response $response,
        $params
    );

}

