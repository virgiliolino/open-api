<?php
namespace Dispatcher\OpenApi;

interface Parser {
    public function parse($path): array;
}
