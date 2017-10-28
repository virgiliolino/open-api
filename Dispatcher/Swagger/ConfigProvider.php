<?php
namespace Dispatcher\Swagger;

interface ConfigProvider {
    public function getFromFile($path): array;
}
