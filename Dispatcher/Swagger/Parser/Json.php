<?php
namespace Dispatcher\Swagger\Parser;

class Json implements \Dispatcher\Swagger\Parser {
    public function parse($path): array {
        $rawContent = file_get_contents($path);
        $content = json_decode($rawContent, true);
        return $content;
    }
}
