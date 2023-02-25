<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\PropertyAccess;
use App\Service\Operation;
use App\Service\OperationService;

class OperationServiceTest extends TestCase
{
    public function testAdd(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(60, $operationService->operation(Operation::ADD, 10, 50));
    }

    public function testSubtract(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(115, $operationService->operation(Operation::SUBTRACT, 150, 35));
    }

    public function testMultiply(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(808665, $operationService->operation(Operation::MULTIPLY, 845, 957));
    }

    public function testDivision(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(16, $operationService->operation(Operation::DIVISION, 800, 50));
    }

    public function testPercentage(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(9, $operationService->operation(Operation::PERCENTAGE, 10, 90));
    }

    public function testSquareRoot(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(2, $operationService->operation(Operation::SQUARE_ROOT, 4, null));
    }

    public function testCubeRoot(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(1.4422495703074083, $operationService->operation(Operation::CUBE_ROOT, 3, null));
    }

    public function testExponencial(): void
    {
        $operationService = $this->getOperationService();
        $this->assertEquals(900, $operationService->operation(Operation::EXPONENCIAL, 30, 2));
    }

    /**
     * @return OperationService
     */
    private function getOperationService(): OperationService
    {
        static $service = null;

        if ($service === null) {
            $service = new OperationService();
        }

        return $service;
    }
}
