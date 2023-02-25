<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OperationType;
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

    #[Route('/form', name: 'app_form')]
    public function form(Request $request, OperationServiceInterface $operationService): Response
    {
        $result = null;
        $form = $this->createForm(OperationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $operationService->operation($form->get('operation')->getData(), $form->get('operatorA')->getData(), $form->get('operatorB')->getData());
        }

        return $this->render('operations/form.html.twig', [
            'form' => $form,
            'result' => $result
        ]);
    }

    #[Route('/form-js', name: 'app_form_js')]
    public function formJs(): Response
    {
        $form = $this->createForm(OperationType::class);

        return $this->render('operations/form_js.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{operation}/{operatorA}/{operatorB}', name: 'app_operantion', requirements: ['operatorA' => '[0-9]+(\.[0-9]+)?', 'operatorB' => '[0-9]+(\.[0-9]+)?'])]
    public function operantion(OperationServiceInterface $operationService, string $operation, int|float $operatorA, null|int|float $operatorB = null): Response
    {
        $code = Response::HTTP_OK;
        $data = [];

        try {
            $data['result'] = $operationService->operation($operation, $operatorA, $operatorB);
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
