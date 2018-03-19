<?php declare(strict_types=1);

namespace App\Flyweight\UnitType;


use App\Flyweight\AbstractUnitType;

class Aircraft extends AbstractUnitType
{
    protected $allowedTerrains = [
        'water', 'flat', 'mountains', 'swamp'
    ];

    public function getId(): string
    {
        return 'aircraft';
    }
}