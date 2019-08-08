<?php

declare(strict_types=1);

namespace App\Service\Strategy;

interface TermStrategyInterface
{
    /**
     * @param int $type
     *
     * @return bool
     */
    public function isReadable(int $type): bool;

    /**
     * @param int $amount
     * @return int
     */
    public function read(int $amount): int;
}