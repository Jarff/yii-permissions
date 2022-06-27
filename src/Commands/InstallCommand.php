<?php
namespace Softbox\YiiPermissions\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
 
class InstallCommand extends Command
{
    protected function configure()
    {
        $this->setName('softbox:install')
            ->setDescription('Handle Installations, and migrations for this package');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filesystem = new Filesystem();
        $output->writeln(sprintf('Copying migrations...'));
        if($filesystem->exists(__DIR__.'/../../../../../Migrations') && $filesystem->exists(__DIR__.'/../Migrations/Version20220526160818.php')){
            $filesystem->mirror(__DIR__.'/../Migrations', __DIR__.'/../../../../../Migrations');
            $output->writeln(sprintf('Migrations Copied'));
        }else{
            $output->writeln(sprintf('Migrations Folder Doesnt exists'));
        }
        $output->writeln(sprintf('Copying providers...'));
        if($filesystem->exists(__DIR__.'/../../../../../protected/clases/Softbox/Providers')){
            $filesystem->mirror(__DIR__.'/../Providers', __DIR__.'/../../../../../protected/clases/Softbox/Providers');
            $output->writeln(sprintf('Providers Copied'));
        }else{
            $filesystem->mkdir(__DIR__.'/../../../../../protected/clases/Softbox/Providers', 000);
            $filesystem->mirror(__DIR__.'/../Providers', __DIR__.'/../../../../../protected/clases/Softbox/Providers');
            $output->writeln(sprintf('Providers Copied'));
        }
    }
}