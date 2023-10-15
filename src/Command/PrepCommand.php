<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Proof;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('prep')]
class PrepCommand extends Command
{
    private readonly EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Creating an entity ...');
        $proof = new Proof('ABC');
        dump($proof);

        $output->writeln('Persist and flush ...');
        $this->manager->persist($proof);
        $this->manager->flush();

        $output->writeln('Post flush.');
        dump($proof);

        $output->writeln('Done.');
        return Command::SUCCESS;
    }
}
