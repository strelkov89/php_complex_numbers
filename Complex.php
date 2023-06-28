<?php

declare(strict_types=1);

namespace App\Complex;

final class Complex
{
    public function __construct(
        private int|float $real,
        private int|float $imaginary
    ) {}

    public function __get(string $name): int|float|null
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }

    public function __toString(): string
    {
        if ($this->imaginary > 0) {
            $imaginaryStr = '+' . (string)$this->imaginary . 'i';
        } elseif ($this->imaginary === 0) {
            $imaginaryStr = '';
        } else {
            $imaginaryStr = (string)$this->imaginary . 'i';
        }

        if ($this->real === 0 && $this->imaginary === 0) {
            return '0';
        } else {
            return (string)$this->real . $imaginaryStr;
        }
    }

    public static function toJson(Complex $a): string
    {
        return json_encode(['real' => $a->real, 'imaginary' => $a->imaginary]);
    }

    public static function addition(Complex $a, Complex $b): Complex
    {
        return new Complex($a->real + $b->real, $a->imaginary + $b->imaginary);
    }

    public static function subtraction(Complex $a, Complex $b): Complex
    {
        return new Complex($a->real - $b->real, $a->imaginary - $b->imaginary);
    }

    public static function multiplication(Complex $a, Complex $b): Complex
    {
        return new Complex(
            $a->real * $b->real - $a->imaginary * $b->imaginary,
            $a->imaginary * $b->real + $a->real * $b->imaginary
        );
    }

    public static function division(Complex $a, Complex $b): Complex
    {
        $divider = $b->real * $b->real + $b->imaginary * $b->imaginary;

        return new Complex(
            ($a->real * $b->real + $a->imaginary * $b->imaginary) / $divider,
            ($a->imaginary * $b->real - $a->real * $b->imaginary) / $divider
        );
    }
}