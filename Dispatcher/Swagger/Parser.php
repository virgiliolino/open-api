<?php
namespace Dispatcher\Swagger;

interface Parser {
    public function parse($path): array;
}
