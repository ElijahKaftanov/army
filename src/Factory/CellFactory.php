<?php declare(strict_types=1);

namespace App\Factory;


use App\Flyweight\TerrainInterface;
use App\Model\Cell;
use App\Model\CellInterface;
use App\Type\Coords;

/**
 * Class CellFactory
 * @package App\Factory
 */
class CellFactory
{
    /**
     * @var TerrainInterface[]
     */
    protected $terrains;

    public function __construct(iterable $terrains)
    {
        foreach ($terrains as $terrain) {
            $this->addTerrain($terrain);
        }
    }

    /**
     * @param Coords $coords
     * @param string $terrainId
     * @return CellInterface
     */
    public function create(Coords $coords, string $terrainId): CellInterface
    {
        $terrain = $this->getTerrainById($terrainId);

        return new Cell($coords, $terrain);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function getTerrainById(string $id)
    {
        return $this->terrains[$id];
    }

    /**
     * @param TerrainInterface $terrain
     */
    protected function addTerrain(TerrainInterface $terrain)
    {
        $this->terrains[$terrain->getId()] = $terrain;
    }
}