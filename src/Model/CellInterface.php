<?php declare(strict_types=1);

namespace App\Model;


use App\Flyweight\TerrainInterface;
use App\Type\Coords;

interface CellInterface
{
    /**
     * @return Coords
     */
    public function getCoords(): Coords;

    /**
     * @return TerrainInterface
     */
    public function getTerrain(): TerrainInterface;

    /**
     * @return UnitInterface|null
     */
    public function getUnit(): ?UnitInterface;

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canSettle(UnitInterface $unit): bool;

    /**
     * @param UnitInterface $unit
     */
    public function settle(UnitInterface $unit): void;

    /**
     * @param UnitInterface $unit
     */
    public function unsettle(UnitInterface $unit): void;
}