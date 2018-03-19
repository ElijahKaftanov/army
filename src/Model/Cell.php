<?php declare(strict_types=1);

namespace App\Model;


use App\Flyweight\TerrainInterface;
use App\Type\Coords;

class Cell implements CellInterface
{
    /**
     * @var Coords
     */
    private $coords;
    /**
     * @var TerrainInterface
     */
    private $terrain;

    private $unit;

    public function __construct(
        Coords $coords,
        TerrainInterface $terrain
    )
    {
        $this->coords = $coords;
        $this->terrain = $terrain;
    }

    /**
     * @return Coords
     */
    public function getCoords(): Coords
    {
        return $this->coords;
    }

    /**
     * @return TerrainInterface
     */
    public function getTerrain(): TerrainInterface
    {
        return $this->terrain;
    }

    /**
     * @return UnitInterface|null
     */
    public function getUnit(): ?UnitInterface
    {
        return $this->unit;
    }

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canSettle(UnitInterface $unit): bool
    {
        return !isset($this->unit);
    }

    /**
     * @param UnitInterface $unit
     * @throws \Exception
     */
    public function settle(UnitInterface $unit): void
    {
        if (!$this->canSettle($unit)) {
            throw new \Exception();
        }
        $this->unit = $unit;
    }

    /**
     * @param UnitInterface $unit
     */
    public function unsettle(UnitInterface $unit): void
    {
        unset($this->unit);
    }
}