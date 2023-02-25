<?php

namespace App\Service;

use InvalidArgumentException;

interface OperationServiceInterface
{
    /**
     * Realiza una operación según el parámetro $operation
     * @param Operation $operation
     * @param int|float $operatorA
     * @param int|float|null $operatorB
     * @return int|float
     * @throws InvalidArgumentException
     */
    public function operation(Operation $operation, int|float $operatorA, int|float|null $operatorB): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function add(int|float $operatorA, int|float $operatorB): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function subtract(int|float $operatorA, int|float $operatorB): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function multiply(int|float $operatorA, int|float $operatorB): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function division(int|float $operatorA, int|float $operatorB): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function percentage(int|float $operatorA, int|float $operatorB): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @return int|float
     */
    public function squareRoot(int|float $operatorA): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @return int|float
     */
    public function cubeRoot(int|float $operatorA): int|float;

    /**
     * Realiza una operación de suma
     * @param int|float $operatorA
     * @param int|float $operatorB
     * @return int|float
     */
    public function exponencial(int|float $operatorA, int|float $operatorB): int|float;
}