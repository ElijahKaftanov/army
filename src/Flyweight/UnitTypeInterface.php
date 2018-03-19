<?php declare(strict_types=1);

namespace App\Flyweight;


use App\Contract\Identifiable;
use App\Model\CellInterface;

interface UnitTypeInterface extends Identifiable
{
    public function canBecome(CellInterface $cell): bool;
}