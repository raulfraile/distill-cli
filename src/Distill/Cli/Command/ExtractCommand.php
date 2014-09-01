<?php

namespace Distill\Cli\Command;

use Distill\Distill;
use Distill\File;
use Distill\Format\FormatGuesser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExtractCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('extract')
            ->setDescription('Extracts files from a compressed archive')
            ->addArgument('file', InputArgument::REQUIRED, 'Compressed archive')
            ->addArgument('target', InputArgument::OPTIONAL, 'Destination', '.')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $extractor = new Distill();
        $formatGuesser = new FormatGuesser();

        $file = new File($input->getArgument('file'), $formatGuesser->guess($input->getArgument('file')));

        $response = $extractor->extract($file, $input->getArgument('target'));

        return true === $response ? 0 : 1;
    }

}
