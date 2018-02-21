<?php
namespace Dispatcher\OpenApi\Validators;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;

interface RequestValidator
{
    public function isValid(
        $route,
        $method,
        ContainerInterface $requestParams,
        RequestInterface $request
    ): bool;
}
