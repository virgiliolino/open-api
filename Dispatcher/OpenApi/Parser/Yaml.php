<?php
namespace Dispatcher\OpenApi\Parser;

class Yaml implements \Dispatcher\OpenApi\Parser {
    public function parse($path): array {
        return \yaml_parse_file($path);
    }
}
