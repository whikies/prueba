<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\Operation;
use App\Service\OperationServiceInterface;
use Exception;
use InvalidArgumentException;

#[AsCommand(
    name: 'app:operation',
    description: 'Comando para hacer diferentes operaciones matemáticas',
)]
class OperationCommand extends Command
{
    /**
     * @param OperationServiceInterface $operationService
     */
    public function __construct(private OperationServiceInterface $operationService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('operation', InputArgument::REQUIRED, sprintf("Operación que se quiere realizar.\nPosibles operaciones: %s", implode(', ', Operation::values())))
            ->addArgument('operatorA', InputArgument::REQUIRED, 'Operador A')
            ->addArgument('operatorB', InputArgument::OPTIONAL, 'Operador B')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $result = $this->operationService->operation(
                Operation::fromName($input->getArgument('operation')),
                $this->validateNumber($input->getArgument('operatorA')),
                $this->validateNumber($input->getArgument('operatorB'))
            );
            $io->success(sprintf('El resultado de la operación "%s" es: %s', $input->getArgument('operation'), $result));
        } catch (InvalidArgumentException $e) {
            $io->error(sprintf("Ha ocurrido un error con los parámetros obtenidos.\nError: %s", $e->getMessage()));
        } catch (Exception $e) {
            $io->error(sprintf("Ha ocurrido un error.\nError: %s", $e->getMessage()));
        }

        return Command::SUCCESS;
    }

    /**
     * Valida que el argumento que se pase sea un número
     * @param string|null $operator
     * @return int|float|null
     * @throws InvalidArgumentException
     */
    private function validateNumber(?string $operator): int|float|null
    {
        if (is_null($operator) || is_numeric($operator)) {
            return $operator;
        }

        throw new InvalidArgumentException(sprintf('El valor "%s" no es un valor válido', $operator));
    }
}
