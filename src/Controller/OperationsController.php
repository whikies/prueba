<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Operation;
use App\Service\OperationServiceInterface;
use Exception;
use InvalidArgumentException;

class OperationsController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('operations/index.html.twig');
    }

    #[Route('/{operation}/{operatorA}/{operatorB}', name: 'app_operantion', requirements: ['operatorA' => '[0-9]+(\.[0-9]+)?', 'operatorB' => '[0-9]+(\.[0-9]+)?'])]
    public function operantion(OperationServiceInterface $operationService, string $operation, int|float $operatorA, null|int|float $operatorB = null): Response
    {
        $code = Response::HTTP_OK;
        $data = [];

        try {
            $data['result'] = $operationService->operation(Operation::fromName($operation), $operatorA, $operatorB);
        } catch (InvalidArgumentException $e) {
            $code = Response::HTTP_BAD_REQUEST;
            $data = [
                'error' => Response::HTTP_BAD_REQUEST,
                'errorDescription' => $e->getMessage()
            ];
        } catch (Exception $e) {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $data = [
                'error' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'errorDescription' => $e->getMessage()
            ];
        }

        return $this->json($data, $code);
    }
}
