<?php declare(strict_types=1);

namespace App\Flyweight\Terrain;


use App\Flyweight\TerrainInterface;

class Flat implements TerrainInterface
{

    public function getId(): string
    {
        return 'flat';
    }
}