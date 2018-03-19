<?php declare(strict_types=1);

namespace App\Flyweight\UnitType;


use App\Flyweight\AbstractUnitType;

class Machine extends AbstractUnitType
{
    protected $allowedTerrains = [
        'flat', 'swamp'
    ];

    public function getId(): string
    {
        return 'machine';
    }
}