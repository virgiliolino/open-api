<?php
namespace Dispatcher\OpenApi;

use Dispatcher\OpenApi\Application\Bridge\RouteInterface;
use Dispatcher\OpenApi\Route\Action;
use Dispatcher\OpenApi\Route\Method;
use Dispatcher\OpenApi\Route\Middleware;
use Dispatcher\OpenApi\Route\NamespaceValue;
use Dispatcher\OpenApi\Route\Prefix;
use Dispatcher\OpenApi\Route\Uri;

final class Route implements RouteInterface {
    private $method;
    private $uri;
    private $action;
    private $namespace;
    private $prefix;
    private $errors;
    private $middleware;
    private $isValid;

    public function __construct(
        Method $method,
        Uri $uri,
        Action $action,
        NamespaceValue $namespace,
        Prefix $prefix,
        Middleware $middleware,
        array $errors = []
    ) {
        $this->method = $method;
        $this->uri = $uri;
        $this->action = $action;
        $this->namespace = $namespace;
        $this->prefix = $prefix;
        $this->middleware = $middleware;
        $this->errors = $errors;
        $this->isValid = !(is_array($errors) && count($errors) > 0);
    }

    public function getMethod(): Method {
        return $this->method;
    }

    public function getUri(): Uri {
        return $this->uri;
    }

    public function getAction(): Action {
        return $this->action;
    }

    public function getNamespace(): NamespaceValue {
        return $this->namespace;
    }

    public function getPrefix(): Prefix {
        return $this->prefix;
    }

    public function getMiddleware(): Middleware {
        return $this->middleware;
    }

    public function isValid(): bool {
        return $this->isValid;
    }
}



