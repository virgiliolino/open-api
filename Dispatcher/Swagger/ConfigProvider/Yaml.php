<?php
namespace Dispatcher\Swagger\ConfigProvider;

class Yaml implements \Dispatcher\Swagger\ConfigProvider {
    public function getFromFile($path): array {
        return \yaml_parse_file($path);
    }
}
