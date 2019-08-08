<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\Strategy\TermContext;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class StrategyCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected static $defaultName = 'strategy:run';

    /**
     * @var TermContext
     */
    private $termContext;

    /**
     * @param TermContext $termContext
     */
    public function __construct(TermContext $termContext)
    {
        $this->termContext = $termContext;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->addOption('term', null, InputOption::VALUE_REQUIRED);

        $this
            ->addOption('amount', null, InputOption::VALUE_REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo $this->termContext->read((int)$input->getOption('term'), (int)$input->getOption('amount'));
    }
}