<?php
namespace Dispatcher\OpenApi\Validators;

use Dispatcher\OpenApi\Application\Bridge\ApplicationBridge;
use Dispatcher\OpenApi\Commandregisterer\DefaultCommandRegisterer;
use Dispatcher\OpenApi\RoutesInjector\SlimRoutesInjector;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;

class NullRequestValidator implements RequestValidator {
    public function isValid(
        $route,
        $method,
        ContainerInterface $requestParams,
        RequestInterface $request
    ): bool {
        return true;
    }
}
