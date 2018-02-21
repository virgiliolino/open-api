<?php
namespace Dispatcher\OpenApi;

use \Psr\Container\ContainerInterface;

class Elements implements ContainerInterface {
    private $elements;

    public function __construct(array $elements) {
        $this->elements = $elements;
    }
    public function get($id) {
        return $this->elements[$id];
    }

    public function has($id): bool {
        return isset($this->elements[$id]);
    }
}
