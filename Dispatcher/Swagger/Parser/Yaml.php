<?php
namespace Dispatcher\Swagger\Parser;

class Yaml implements \Dispatcher\Swagger\Parser {
    public function parse($path): array {
        return \yaml_parse_file($path);
    }
}
