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

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Self update command.
 *
 * @author Igor Wiedler <igor@wiedler.ch>
 * @author Stephane PY <py.stephane1@gmail.com>
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 * @author Raul Fraile <raulfraile@gmail.com>
 */
class SelfUpdateCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('self-update')
            ->setAliases(array('selfupdate'))
            ->setDescription('Update distill-cli.phar to the latest version.')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command replace your distill-cli.phar by its latest version.

<info>php distill-cli.phar %command.name%</info>

EOT
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        preg_match('/\((.*?)\)$/', $this->getApplication()->getLongVersion(), $match);
        $localVersion = isset($match[1]) ? $match[1] : '';

        if (false !== $remoteVersion = @file_get_contents('https://raw.githubusercontent.com/raulfraile/distill-cli/master/bin/latest.version')) {
            if ($localVersion === $remoteVersion) {
                $output->writeln('<info>php-cs-fixer is already up to date.</info>');

                return;
            }
        }

        $remoteFilename = 'https://raw.githubusercontent.com/raulfraile/distill-cli/master/bin/distill-cli.phar';
        $localFilename = $_SERVER['argv'][0];
        $tempFilename = basename($localFilename, '.phar').'-tmp.phar';
        if (false === @file_get_contents($remoteFilename)) {
            $output->writeln('<error>Unable to download new versions from the server.</error>');

            return 1;
        }

        try {
            copy($remoteFilename, $tempFilename);
            chmod($tempFilename, 0777 & ~umask());

            // test the phar validity
            $phar = new \Phar($tempFilename);
            // free the variable to unlock the file
            unset($phar);
            rename($tempFilename, $localFilename);

            $output->writeln('<info>distill-cli updated.</info>');
        } catch (\Exception $e) {
            if (!$e instanceof \UnexpectedValueException && !$e instanceof \PharException) {
                throw $e;
            }
            unlink($tempFilename);
            $output->writeln(sprintf('<error>The download is corrupt (%s).</error>', $e->getMessage()));
            $output->writeln('<error>Please re-run the self-update command to try again.</error>');

            return 1;
        }
    }
}