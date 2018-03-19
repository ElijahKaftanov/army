<?php declare(strict_types=1);

namespace App\Type;

/**
 * Class Coords
 * @package App\Type
 */
class Coords
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $y;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}