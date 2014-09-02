<?php

/*
 * This file is part of the Distill CLI package.
 *
 * (c) Raul Fraile <raulfraile@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * App version.
     * @var string
     */
    protected $appVersion;

    /**
     * Constructor.
     * @param string $appVersion App version
     */
    public function __construct($appVersion)
    {
        parent::__construct();

        $this->appVersion = $appVersion;
    }

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

        $output->writeln(sprintf("distill-cli %s by Raul Fraile.\n", $this->appVersion));

        $output->write(sprintf("Uncompressing '%s' into '%s' ", $input->getArgument('file'), $input->getArgument('target')));

        $extractor = new Distill();
        $formatGuesser = new FormatGuesser();

        $file = new File($input->getArgument('file'), $formatGuesser->guess($input->getArgument('file')));

        $response = $extractor->extract($file, $input->getArgument('target'));

        if (true == $response) {
            $output->writeln('[<info>OK</info>]');

            return 0;
        }

        $output->writeln('<error>ERROR</error>');

        return 1;
    }

}
