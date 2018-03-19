<?php declare(strict_types=1);

namespace App\Flyweight;

use App\Model\CellInterface;

abstract class AbstractUnitType implements UnitTypeInterface
{
    protected $allowedTerrains;

    public function canBecome(CellInterface $cell): bool
    {
        $terrain = $cell->getTerrain();


        if (in_array($terrain->getId(), $this->allowedTerrains)) {
            return true;
        }

        return false;
    }
}