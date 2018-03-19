<?php declare(strict_types=1);

namespace App\Flyweight\UnitType;


use App\Flyweight\AbstractUnitType;

class Base extends AbstractUnitType
{
    protected $allowedTerrains = ['flat'];

    public function getId(): string
    {
        return 'base';
    }
}