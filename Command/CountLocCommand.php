<?php
namespace c975L\SymfonyCountLinesCodeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CountLocCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('count:loc')
             ->setDescription('Count lines of code written in Symfony project');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $extensions = array("php", "js", "twig", "css");

        $command = "cd src/ && wc -l `find . -iname ";

        foreach($extensions as $key => $extension) {

            $command .= '"*.'.$extension.'"';

            if($key < count($extensions) - 1) {
                $command .= " -o -iname ";
            }
        }

        $command .= "` > count.txt && tail -1 count.txt";

        $result = preg_replace('/\D/', '', shell_exec($command));

        shell_exec('cd src/ && rm count.txt');

        $output->writeln('<info>Impressive! You wrote '.$result.' lines of code!</info>');
    }
}
