<?php
namespace Dispatcher\OpenApi\Route;

use Bridge\Application\ApplicationBridge;
use Bridge\Application\Route\RouteFactory;
use Dispatcher\OpenApi\CommandRegisterer;
use Dispatcher\OpenApi\Elements;
use Dispatcher\OpenApi\Validators\NullParamsValidator;
use Dispatcher\OpenApi\Validators\NullRequestValidator;
use \Psr\Container\ContainerInterface;
use \Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;

class DefaultRouteInjector implements RouteInjector {
    /** @var ParamsValidator $paramsValidator */
    private $paramsValidator;
    /** @var RequestsValidator $requestsValidator */
    private $requestValidator;

    public function __construct(
        ParamsValidator $paramsValidator = null,
        RequestValidator $requestValidator = null
    ) {
        $this->paramsValidator = $paramsValidator ?: new NullParamsValidator();
        $this->requestValidator = $requestValidator ?: new NullRequestValidator();
    }

    public function inject(
        ApplicationBridge $app,
        $config,
        CommandRegisterer $commandRegisterer = null
    ) {
        $customInfo = isset($config['info']['x-custom-info']) ?
            $config['info']['x-custom-info'] : [];
        $securityAttributes = [];
        if (isset($customAttributes['secure'])) {
            $securityAttributes = $customInfo['secure'];
            unset($customInfo['secure']);
        }
        $customAttributes = $customInfo ?: [];

        foreach ($config['paths'] as $uri => $path) {
            foreach ($path as $method => $data) {
                $action = $data['operationId'];
                $attributes = [];
                $parameters = isset($data['parameters']) ?
                    $data['parameters'] : [];
                $requestParams = $parameters; //new Elements($parameters);
                $routeSecurity = isset($data['security']) ?
                    $data['security'] : [];
                $tags = isset($data['tags']) ?
                    $data['tags'] : [];
                foreach ($routeSecurity as $directive) {
                    foreach ($directive as $key => $value) {
                        if (isset($securityAttributes[$key])) {
                            $attributes = array_merge(
                                $attributes,
                                $securityAttributes[$key]
                            );
                        }
                    }
                }
                foreach ($tags as $tag) {
                    if (isset($customAttributes[$tag])) {
                        $attributes = array_merge(
                            $attributes,
                            $customAttributes[$tag]
                        );
                    }
                }
                if (isset($customAttributes[$action])) {
                    $attributes = array_merge(
                        $attributes,
                        $customAttributes[$action]
                    );
                }

                if (isset($customAttributes['*'])) {
                    $attributes = array_merge(
                        $attributes,
                        $customAttributes['*']
                    );
                }

                $app->addRoute(
                    RouteFactory::create(
                        $method,
                        $uri,
                        $action,
                        $attributes
                    /*$commandRegisterer->register(
                        $route,
                        $method,
                        $data['operationId'],
                        $requestParams,
                        $this->paramsValidator,
                        $this->requestValidator,
                        $app
                    )*/
                    )
                );
            }
        }
    }
}
