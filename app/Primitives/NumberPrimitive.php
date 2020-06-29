<?php


namespace App\Primitives;


use Exception;

class NumberPrimitive
{
    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function parse($value)
    {
        $negative_Integer = strpos(substr($value, 0, 1), '-') !== false;

        if ($value !== null) {
            $value = self::cleanString($value);
        }
        if ($negative_Integer) {
            $value *= -1;
        }

        return new self($value);
    }

    public function toProtocol() : string
    {
        return '#' . str_pad($this->value, '6', '0', STR_PAD_LEFT);
    }

    public function toInt()
    {
        return (int)$this->value;
    }

    public function toString(): ?string
    {
        return $this->value;
    }

    public static function cleanString($string)
    {
        $valid_string = '';
        $chars        = str_split($string);
        foreach ($chars as $char) {
            if (is_numeric($char)) {
                $valid_string .= $char;
            }
        }

        throw_if($valid_string === '', new Exception("Non numeric value found"));

        return $valid_string;
    }

    public function __toString(): ?string
    {
        return $this->toString();
    }
}
