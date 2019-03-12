<?php
/*
 * (c) 2017: 975L <contact@975l.com>
 * (c) 2017: Laurent Marquet <laurent.marquet@laposte.net>
 *
 * Fork from: https://github.com/BastienL/Symfony2Loc
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace c975L\CountLinesCodeBundle\Command;

use c975L\ConfigBundle\Service\ConfigServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Console command to count lines of code in project, executed with 'count:loc'
 * @author Laurent Marquet <laurent.marquet@laposte.net>
 * @copyright 2017 975L <contact@975l.com>
 */
class CountLocCommand extends Command
{
    /**
     * Stores ConfigServiceInterface
     * @var ConfigServiceInterface
     */
    private $configService;

    public function __construct(ConfigServiceInterface $configService)
    {
        parent::__construct();
        $this->configService = $configService;
    }

    protected function configure()
    {
        $this
            ->setName('count:loc')
            ->setDescription('Count lines of code written in Symfony project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Creates tmp Directory if not exists
        $directory = 'var/tmp/CountLinesCode/';
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        //Gets data
        $extensions = $this->configService->getParameter('c975_l_count_lines_code.extensions');
        $folders = $this->configService->getParameter('c975_l_count_lines_code.folders');

        //Creates the command line to be executed
        $resultFinal = 0;
        $resultOuput = array();
        foreach ($folders as $folder) {
            if (is_dir($folder)) {
                $filename = $directory . str_replace('/', '', $folder);

                $command = "wc --lines `find $folder -iname ";
                foreach ($extensions as $key => $extension) {
                    $command .= '"*.' . $extension . '"';
                    if ($key < count($extensions) - 1) {
                        $command .= ' -o -iname ';
                    }
                }
                $command .= "` > $filename.txt && tail -1 $filename.txt;";

                $result = (int) preg_replace('/\D/', '', shell_exec($command));

                $resultOuput[] = array($folder, $result);
                $resultFinal += $result;
            }
        }

        //Output data
        $io = new SymfonyStyle($input, $output);
        $io->title('Count Lines Code');
        $io->text('Lines of code have been counted for directories below, using the following extensions');
        $io->listing($extensions);
        $io->table(
            array('Directory', 'Lines of code'),
            $resultOuput
        );
        $io->note('Files containing details are stored under ' . $directory);
        $io->success('Project contains ' . $resultFinal . ' lines of code!');
    }
}
