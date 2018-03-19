<?php declare(strict_types=1);

namespace App\Exception;


use App\Model\CellInterface;
use App\Type\Coords;

class MapException extends \Exception
{
    public static function cellAlreadyExists(CellInterface $cell)
    {
        $coords = $cell->getCoords();
        return new self("Cell $coords already exists in map");
    }

    public static function undefinedCell(Coords $coords)
    {
        $coords = self::coordsToString($coords);
        return new self("Cell $coords is not defined in map");
    }

    protected static function coordsToString(Coords $coords) : string
    {
        return "({$coords->getX()},{$coords->getY()})";
    }
}