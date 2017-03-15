<?php
namespace c975L\SymfonyCountLinesCodeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CountLocCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('count:loc')
            ->setDescription('Count lines of code written in Symfony project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Creates tmp Directory if not exists
        $directory = 'var/tmp/SymfonyCountLinesCode/';
        if (!is_dir($directory)) mkdir($directory, 0777, true);

        $folders = array(
            'src/',
            'app/Resources/views/',
            'tests/',
            'web/css/',
        );

        $extensions = array(
            'php',
            'js',
            'twig',
            'css'
        );

        //Creates the command line to be executed
        $resultFinal = 0;
        $resultOuput = array();
        foreach ($folders as $folder) {
            $filename = $directory . str_replace('/', '', $folder);

            $command = "wc --lines `find $folder -iname ";
            foreach($extensions as $key => $extension) {
                $command .= '"*.' . $extension . '"';
                if($key < count($extensions) - 1) {
                    $command .= ' -o -iname ';
                }
            }
            $command .= "` > $filename.txt && tail -1 $filename.txt;";

            $result = (int) preg_replace('/\D/', '', shell_exec($command));

            $resultOuput[] = array($folder, $result);
            $resultFinal += $result;
        }

        //Output data
        $io = new SymfonyStyle($input, $output);
        $io->title('Symfony Count Lines Code');
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
