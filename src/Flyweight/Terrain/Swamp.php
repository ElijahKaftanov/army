<?php declare(strict_types=1);

namespace App\Flyweight\Terrain;


use App\Flyweight\TerrainInterface;

class Swamp implements TerrainInterface
{
    public function getId(): string
    {
        return 'swamp';
    }
}