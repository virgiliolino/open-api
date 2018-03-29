<?php
namespace Dispatcher\OpenApi;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface CommandHandler {
    public function execute(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $params,
        $customAttributes = []
    );
}

