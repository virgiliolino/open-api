<?php
namespace Dispatcher\OpenApi;

use Bridge\Application\ApplicationBridge;
use Dispatcher\OpenApi\CommandRegisterer\DefaultCommandRegisterer;
use Dispatcher\OpenApi\Route\DefaultRouteInjector;
use Dispatcher\OpenApi\Route\RouteInjector;
use Dispatcher\OpenApi\Validators\NullParamsValidator;
use Dispatcher\OpenApi\Validators\NullRequestValidator;
use Dispatcher\OpenApi\Validators\ParamsValidator;
use Dispatcher\OpenApi\Validators\RequestValidator;
use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class OpenApiDispatcher {
    /** @var RouteInjector $routesInjector */
    private $routesInjector;

    public function __construct(
        RouteInjector $routesInjector = null,
        ParamsValidator $paramsValidator = null,
        RequestValidator $requestValidator = null
    ) {
        $paramsValidator = $paramsValidator ?: new NullParamsValidator();
        $requestValidator = $requestValidator ?: new NullRequestValidator();
        $this->routesInjector = $routesInjector ?: new DefaultRouteInjector($paramsValidator, $requestValidator);
    }

    public function InjectRoutesFromConfig(
        ApplicationBridge $app,
        $config,
        Commandregisterer $commandRegisterer = null
    ) {
        //$commandRegisterer = $commandRegisterer ?: new DefaultCommandRegisterer();
        $this->routesInjector->inject($app, $config, $commandRegisterer);
    }

}
