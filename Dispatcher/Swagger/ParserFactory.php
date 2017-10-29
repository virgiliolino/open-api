<?php
namespace Dispatcher\Swagger;

class ParserFactory {
    const JSON_PARSER = 'json';
    const YAML_PARSER = 'yaml';
    
    private static $parserMapper = [
        self::JSON_PARSER => 'Dispatcher\Swagger\Parser\Json',
        self::YAML_PARSER => 'Dispatcher\Swagger\Parser\Yaml',
    ];
    
    public static function parserFor($path): Parser {
        $extension = substr($path, -4);
        $parserName = self::$parserMapper[$extension];
        return new $parserName();
    }
}
