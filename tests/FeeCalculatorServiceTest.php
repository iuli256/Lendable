<?php

namespace App\Tests;

use App\Model\LoanApplication;
use App\Service\Fee\FeeCalculatorService;
use App\Service\Strategy\TermContext;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class FeeCalculatorServiceTest extends TestCase
{
    /** @var FeeCalculatorService $feeCalculatorService */
    protected $feeCalculatorService;

    /** @var TermContext $termContext */
    protected $termContext;

    protected function setUp()
    {
        parent::setUp();

        $this->feeCalculatorService = m::mock(FeeCalculatorService::class)->makePartial();
        $this->termContext = m::mock(TermContext::class)->makePartial();

        $this->feeCalculatorService
            ->setTermContext($this->termContext);
    }

    public function testCalculateTerm12()
    {
        $application = new LoanApplication(12,1000);
        $this->termContext = m::mock(TermContext::class)->makePartial();

        $this->termContext
            ->shouldReceive('read')
            ->andReturn(70);

        $response = $this->feeCalculatorService->calculate($application);

        $this->assertEquals(70, $response);
    }
}
