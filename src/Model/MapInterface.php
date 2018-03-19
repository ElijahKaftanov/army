<?php declare(strict_types=1);

namespace App\Model;


use App\Type\Coords;

interface MapInterface
{
    /**
     * @param Coords $coords
     * @return bool
     */
    public function hasCell(Coords $coords): bool;

    /**
     * @param Coords $coords
     * @return CellInterface
     */
    public function getCell(Coords $coords): CellInterface;
}