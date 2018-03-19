<?php declare(strict_types=1);

namespace App\Generator;


use App\Factory\CellFactory;
use App\Factory\UnitFactory;
use App\Model\Cell;
use App\Model\CellInterface;
use App\Model\Map;
use App\Model\MapInterface;
use App\Flyweight\TerrainInterface;
use App\Model\UnitInterface;
use App\Type\Coords;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class MapGenerator
 * @package App\Generator
 */
class MapGenerator
{
    protected static $defaultConfig = [
        'map' => [
            'max' => [
                'x' => 100,
                'y' => 100
            ]
        ],
        'teams' => 2,
        'units' => [
            'base' => 1,
            'human' => 4,
            'machine' => 3,
            'aircraft' => 2
        ],
        'terrains' => [
            'flat',
            'water',
            'mountains',
            'swamp'
        ]
    ];

    /**
     * @var array
     */
    private $config;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var UnitFactory
     */
    private $unitFactory;
    /**
     * @var CellFactory
     */
    private $cellFactory;

    public function __construct(
//        EventDispatcherInterface $dispatcher,
        UnitFactory $unitFactory,
        CellFactory $cellFactory
    )
    {
//        $this->dispatcher = $dispatcher;
        $this->unitFactory = $unitFactory;
        $this->cellFactory = $cellFactory;
    }

    /**
     * @param array $config
     * @return MapInterface
     * @throws \Exception
     */
    public function create(array $config = []): MapInterface
    {
        $this->config = array_merge(static::$defaultConfig, $config);
        $map = $this->generateMap();
        $this->generateUnits($map);

        return $map;
    }

    /**
     * @param MapInterface $map
     * @throws \Exception
     */
    protected function generateUnits(MapInterface $map)
    {
        $teamCount = $this->config['teams'];
        $units = $this->config['units'];
        for ($i = 0; $i < $teamCount; $i++) {
            foreach ($units as $typeId => $count) {
                $unit = $this->unitFactory->create($typeId);

                for ($j = 0; $j < $count; $j++) {
                    $this->retry(function (MapInterface $map, UnitInterface $unit) {
                        $cell = $this->getRandomCell($map);

                        if ($unit->canBecome($cell)) {
                            $unit->become($cell);
                            return true;
                        }

                        return null;
                    }, [$map, $unit]);
                }
            }
        }
    }

    /**
     * @param callable $func
     * @param array $params
     * @param int $attempts
     * @return mixed
     * @throws \Exception
     */
    private function retry(callable $func, array $params, int $attempts = 500)
    {
        for ($i = 0; $i < $attempts; $i++) {
            $result = call_user_func_array($func, $params);
            if (!is_null($result)) {
                return $result;
            }
        }
        throw new \Exception('Give up');
    }

    /**
     * @param MapInterface $map
     * @return CellInterface
     */
    protected function getRandomCell(MapInterface $map): CellInterface
    {
        $x = rand(0, $this->config['map']['max']['x']);
        $y = rand(0, $this->config['map']['max']['y']);
        $coords = new Coords($x, $y);

        return $map->getCell($coords);
    }

    /**
     * @return MapInterface
     */
    protected function generateMap(): MapInterface
    {
        $matrix = [];
        for ($x = 0; $x <= $this->config['map']['max']['x']; $x++) {
            for ($y = 0; $y <= $this->config['map']['max']['x']; $y++) {
                $matrix[] = $this->cellFactory->create(
                    new Coords($x, $y),
                    $this->getRandomTerrainId()
                );
            }
        }

        return new Map($matrix);
    }

    /**
     * @return string
     */
    private function getRandomTerrainId(): string
    {
        $coll = $this->config['terrains'];
        return $coll[rand(0, count($coll) - 1)];
    }
}