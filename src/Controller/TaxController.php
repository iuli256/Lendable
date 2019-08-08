<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\FeeRequestDto;
use App\Dto\FeeResponseDto;
use App\Service\FeeService;
use Mockery\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;

class TaxController extends AbstractController
{
    /**
     * @Route("/{term<\d+>}/{amount}", name="home")
     * @param $term
     * @param $amount
     * @param FeeService $feeService
     * @return JsonResponse
     * @throws \Exception
     */
    public function index($term, $amount, FeeService $feeService)
    {
        $serializer = new Serializer();

        $requestDto = (new FeeRequestDto())
            ->setTerm($term)
            ->setAmount($amount);

        try {
            $response = $feeService->getResponseFromFeeCalculator($requestDto);

        } catch(Exception $e) {
            $validator = (new FeeResponseDto())
                ->setSuccess(false)
                ->setErrors($e->getMessage());

            $validatorResponse = $serializer->serialize(
                $validator,
                JsonEncoder::FORMAT);

            return new JsonResponse($validatorResponse, 400, [], true);
        }

        $responseJson = $serializer->serialize($response, JsonEncoder::FORMAT);

        return new JsonResponse($responseJson, 200, [], true);
    }
}
