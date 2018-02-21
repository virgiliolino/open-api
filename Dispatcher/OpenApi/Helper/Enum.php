<?php
namespace Dispatcher\OpenApi\Helper;

abstract class Enum {
    private $value;
    protected $possibleValues;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getPossibleValues(): array { return $this->possibleValues; }
    public function isPossibleValue($key) { return isset($this->possibleValues[$key]); }
    public function getValue() { return $this->value; }
    public function isValid(): bool {
        return $this->isPossibleValue($this->getValue());
    }

}