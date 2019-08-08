<?php

declare(strict_types=1);

namespace App\Service\Fee;

use App\Model\LoanApplication;
use App\Service\Strategy\TermContext;

class FeeCalculatorService implements FeeCalculatorInterface
{
   /** @var TermContext $termContext */
    private $termContext;


    public function calculate(LoanApplication $application): float
    {

        return $this->termContext->read((int) $application->getTerm(), (int) $application->getAmount());
    }

    public function setTermContext(TermContext $termContext): FeeCalculatorService
    {
        $this->termContext = $termContext;

        return $this;
    }
}