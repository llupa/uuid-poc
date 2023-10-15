<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Proof;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('does-it-work')]
class DoesItWorkCommand extends Command
{
    private readonly EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Finding entity at a later time ...');
        $proof = $this->manager->getRepository(Proof::class)->findOneBy(['name' => 'ABC']);
        dump($proof);

        $output->writeln('Done.');
        return Command::SUCCESS;
    }
}
