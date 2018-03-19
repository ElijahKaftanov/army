<?php declare(strict_types=1);

namespace App\Model;

use App\Exception\MapException;
use App\Type\Coords;

/**
 * Class Map
 * @package App\Model
 */
class Map implements MapInterface
{
    /**
     * @var Cell[][]
     */
    protected $matrix;

    public function __construct(array $cells)
    {
        foreach ($cells as $cell) {
            $this->addCell($cell);
        }
    }

    /**
     * @param Coords $coords
     * @return bool
     */
    public function hasCell(Coords $coords): bool
    {
        return isset($this->matrix[$coords->getX()][$coords->getY()]);
    }

    /**
     * @param Coords $coords
     * @return CellInterface
     * @throws \Exception
     */
    public function getCell(Coords $coords):CellInterface
    {
        if (!$this->hasCell($coords)) {
            throw MapException::undefinedCell($coords);
        }
        return $this->matrix[$coords->getX()][$coords->getY()];
    }

    /**
     * @param CellInterface $cell
     * @throws \Exception
     */
    protected function addCell(CellInterface $cell): void
    {
        $coords = $cell->getCoords();
        if ($this->hasCell($coords)) {
            throw MapException::cellAlreadyExists($cell);
        }
        $this->matrix[$coords->getX()][$coords->getY()] = $cell;
    }
}