<?php
namespace Dispatcher\OpenApi\Parser;

class Json implements \Dispatcher\OpenApi\Parser {
    public function parse($path): array {
        $rawContent = file_get_contents($path);
        $content = json_decode($rawContent, true);
        return $content;
    }
}
