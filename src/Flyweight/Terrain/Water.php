<?php declare(strict_types=1);

namespace App\Flyweight\Terrain;


use App\Flyweight\TerrainInterface;

class Water implements TerrainInterface
{
    public function getId(): string
    {
        return 'water';
    }
}