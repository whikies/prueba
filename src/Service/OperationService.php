<?php

namespace App\Service;

use InvalidArgumentException;

/**
 * Servicio para hacer diferentes operaciones matemáticas
 */
class OperationService implements OperationServiceInterface
{
    /**
     * Realiza una operación según el parámetro $operation
     * @param Operation $operation
     * @param int|float $operatorA
     * @param int|float|null $operatorB
     * @return int|float
     * @throws InvalidArgumentException
     */
    public function operation(Operation $operation, int|float $operatorA, int|float|null $operatorB): int|float
    {
        $this->validateParams($operation, $operatorA, $operatorB);

        return match($operation) {
            Operation::ADD => $this->add($operatorA, $operatorB),
            Operation::SUBTRACT => $this->subtract($operatorA, $operatorB),
            Operation::MULTIPLY => $this->multiply($operatorA, $operatorB),
            Operation::DIVISION => $this->division($operatorA, $operatorB),
            Operation::PERCENTAGE => $this->percentage($operatorA, $operatorB),
            Operation::SQUARE_ROOT => $this->squareRoot($operatorA),
            Operation::CUBE_ROOT => $this->cubeRoot($operatorA),
            Operation::EXPONENCIAL => $this->exponencial($operatorA, $operatorB),
        default => throw new InvalidArgumentException('Not valid operation')
        };
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function add(int|float $operatorA, int|float $operatorB): int|float
    {
        return $operatorA + $operatorB;
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function subtract(int|float $operatorA, int|float $operatorB): int|float
    {
        return $operatorA - $operatorB;
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function multiply(int|float $operatorA, int|float $operatorB): int|float
    {
        return $operatorA * $operatorB;
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function division(int|float $operatorA, int|float $operatorB): int|float
    {
        return $operatorA / $operatorB;
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function percentage(int|float $operatorA, int|float $operatorB): int|float
    {
        return ($operatorA / 100) * $operatorB;
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @return int|float
     */
    public function squareRoot(int|float $operatorA): int|float
    {
        return sqrt($operatorA);
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @return int|float
     */
    public function cubeRoot(int|float $operatorA): int|float
    {
        return pow($operatorA, 1/3);
    }

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function exponencial(int|float $operatorA, int|float $operatorB): int|float
    {
        return pow($operatorA, $operatorB);
    }

    /**
     * Valida que se pasen los parámetros correctos según la operación que se quiera ejecutar
     * @param Operation $operation
     * @param int|float $operatorA
     * @param int|float|null $operatorB
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateParams(Operation $operation, int|float $operatorA, int|float|null $operatorB): void
    {
        match($operation) {
            Operation::ADD,
            Operation::SUBTRACT,
            Operation::MULTIPLY,
            Operation::PERCENTAGE,
            Operation::EXPONENCIAL => $this->validateNull($operation, $operatorB),
            Operation::DIVISION => $this->validateDivision($operation, $operatorB),
        default => null
        };
    }

    /**
     * Valida que un operador no sea nulo
     * @param Operation $operation
     * @param int|float|null $operator
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateNull(Operation $operation, int|float|null $operator): void
    {
        if ($operator === null) {
            throw new InvalidArgumentException(sprintf('Para el tipo de operación "%s" el operadorB no puede ser nulo', $operation->value));
        }
    }

    /**
     * Valida que un operador de una división para que no sea nulo y tampoco sea un cero
     * @param Operation $operation
     * @param int|float|null $operator
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateDivision(Operation $operation, int|float|null $operator): void
    {
        $this->validateNull($operation, $operator);

        if ($operator === 0) {
            throw new InvalidArgumentException('Una división no se puede dividir por cero');
        }
    }
}
