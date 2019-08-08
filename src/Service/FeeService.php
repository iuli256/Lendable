<?php

namespace App\Service;

use App\Dto\FeeRequestDto;
use App\Service\Fee\FeeCalculatorService;
use App\Model\LoanApplication;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Exception;

/**
 * Class FeeService
 * @package App\Service
 */
class FeeService
{
    /**
     * @var \Symfony\Component\Validator\Validator\RecursiveValidator
     */
    protected $validator;

    /** @var FeeCalculatorService */
    protected $feeCalculatorService;

    /**
     * @param \Symfony\Component\Validator\Validator\RecursiveValidator $validator
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    public function setFeeCalculatorService($feeCalculatorService)
    {
        $this->feeCalculatorService = $feeCalculatorService;

        return $this;
    }

    /**
     * @param FeeRequestDto $requestDto
     * @return float
     * @throws Exception
     */
    public function getResponseFromFeeCalculator(FeeRequestDto $requestDto)
    {
        $errors = $this->validator->validate($requestDto);

        if (\count($errors)) {
            $messages = [];
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }

            throw new Exception('There was a problem with your request: ' . implode(',', $messages));
        }

        $application = new LoanApplication($requestDto->getTerm(),(float) $requestDto->getAmount());

        return $this->feeCalculatorService->calculate($application);
    }
}