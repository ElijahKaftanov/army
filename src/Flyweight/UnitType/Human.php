<?php declare(strict_types=1);

namespace App\Flyweight\UnitType;

use App\Flyweight\AbstractUnitType;

class Human extends AbstractUnitType
{
    protected $allowedTerrains = [
        'water', 'flat', 'mountains',
    ];

    public function getId(): string
    {
        return 'human';
    }

}