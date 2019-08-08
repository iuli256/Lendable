<?php

namespace App\Service\Strategy;

class TermContext
{
    /**
     * @var array
     */
    private $strategies;

    /**
     * @param TermStrategyInterface $strategy
     */
    public function addStrategy(TermStrategyInterface $strategy)
    {
        $this->strategies[] = $strategy;
    }

    /**
     * @param int $type
     * @param int $amount
     * @return int
     */
    public function read(int $type, int $amount): int
    {
        /** @var TermStrategyInterface $strategy */
        foreach ($this->strategies as $strategy) {
            if ($strategy->isReadable($type)) {
                return $strategy->read($amount);
            }
        }

        throw new \InvalidArgumentException('Term type not found');
    }
}