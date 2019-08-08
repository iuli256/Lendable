<?php


namespace App\Dto;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class FeeRequestDto
 * @package AppBundle\Dto\Api
 * @codeCoverageIgnore
 */
class FeeRequestDto
{
    /**
     * @var integer
     *
     * @JMS\Type("integer")
     */
    public $term;

    /**
     * @var float
     *
     * @JMS\Type("float")
     */
    public $amount;

    /**
     * @param ExecutionContextInterface $context
     * @Assert\Callback()
     */
    public function validateFilters(ExecutionContextInterface $context)
    {
        if (null === $this->getAmount()
            && null === $this->getTerm()
        ) {
            $context->buildViolation('You must provide at least one filter!')
                ->addViolation();
        }
    }

    /**
     * @return int
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param int $term
     * @return $this
     */
    public function setTerm($term): FeeRequestDto
    {
        $this->term = $term;

        return $this;
    }

    /**
     * @return $this
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmount($amount): FeeRequestDto
    {
        $this->amount = $amount;

        return $this;
    }
}
