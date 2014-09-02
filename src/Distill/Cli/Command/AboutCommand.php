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
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AboutCommand extends Command
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
            ->setName('about')
            ->setDescription('Extracts files from a compressed archive')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf("\n <info>Distill CLI</info> <comment>%s</comment>", $this->appVersion));
        $output->writeln(" ~~~~~~~~~~~~~~~~~~~~");

        $output->writeln(" Command line tool to extract files from compressed archives. Supports bz2, gz, phar, rar, tar, tar.bz2, tar.gz, tar.xz, 7z, xz and zip archives.\n");

        $output->writeln(" Available commands:");

        $output->writeln("   <info>extract <dir-name></info>  Extracts files from compressed archives.");
        $output->writeln("                   Example: <comment>$ distill-cli extract example.tar.gz example/</comment>\n");

        return 0;
    }

}
