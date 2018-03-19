<?php declare(strict_types=1);

namespace App\Command;


use App\Generator\MapGenerator;
use App\Type\Coords;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MapGenerateCommand extends Command
{
    /**
     * @var MapGenerator
     */
    private $generator;

    public function __construct(MapGenerator $generator)
    {
        $this->generator = $generator;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('map:generate');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $map = $this->generator->create();
        dump($map->getCell(new Coords(12, 32)));
        return true;
    }
}