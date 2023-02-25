<?php

namespace App\Service;

enum Operation: string {
    case ADD = 'add';
    case SUBTRACT = 'subtract';
    case MULTIPLY = 'multiply';
    case DIVISION = 'division';
    case PERCENTAGE = 'percentage';
    case SQUARE_ROOT = 'squareRoot';
    case CUBE_ROOT = 'cubeRoot';
    case EXPONENCIAL = 'exponencial';

    public static function fromName(string $name): static
    {
        return match($name) {
            'add' => static::ADD,
            'subtract' => static::SUBTRACT,
            'multiply' => static::MULTIPLY,
            'division' => static::DIVISION,
            'percentage' => static::PERCENTAGE,
            'squareRoot' => static::SQUARE_ROOT,
            'cubeRoot' => static::CUBE_ROOT,
            'exponencial' => static::EXPONENCIAL,
            default => throw new \InvalidArgumentException('Not valid operation')
        };
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
