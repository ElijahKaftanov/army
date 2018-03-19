<?php declare(strict_types=1);

namespace App\Model;


use App\Flyweight\UnitTypeInterface;

class Unit implements UnitInterface
{
    /**
     * @var UnitTypeInterface
     */
    private $type;

    /**
     * @var CellInterface|null
     */
    private $cell;

    public function __construct(UnitTypeInterface $type)
    {
        $this->type = $type;
    }

    public function canBecome(CellInterface $cell): bool
    {
        return $this->type->canBecome($cell)
            && $cell->canSettle($this);
    }

    public function become(CellInterface $cell): void
    {
        if (!$this->canBecome($cell)) {
            throw new \Exception;
        }

        $this->cell = $cell;
    }
}