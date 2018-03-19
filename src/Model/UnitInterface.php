<?php declare(strict_types=1);

namespace App\Model;


interface UnitInterface
{
    public function canBecome(CellInterface $cell):bool;

    public function become(CellInterface $cell): void;
}