<?php
namespace Dispatcher\OpenApi;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

interface CommandHandler {
    public function execute(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $params,
        $customAttributes = []
    );
}

