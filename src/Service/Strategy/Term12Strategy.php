<?php

declare(strict_types=1);

namespace App\Service\Strategy;

class Term12Strategy implements TermStrategyInterface
{
    private const TYPE = 12;

    /**
     * {@inheritdoc}
     */
    public function isReadable(int $type): bool
    {
        return self::TYPE === $type;
    }

    /**
     * {@inheritdoc}
     */
    public function read(int $amount): int
    {
        switch ($amount)
        {
            case (int) 1000:
            case (int) 2000:
                return 50;

            case (int) 3000:
                return 90;
        }

        throw new \InvalidArgumentException('Amount value not found');
    }
}