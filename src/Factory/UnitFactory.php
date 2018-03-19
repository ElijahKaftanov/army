<?php declare(strict_types=1);

namespace App\Factory;


use App\Flyweight\UnitTypeInterface;
use App\Model\Unit;
use App\Model\UnitInterface;

class UnitFactory
{
    private $types;

    public function __construct(iterable $unitTypes)
    {
        foreach ($unitTypes as $type) {
            $this->addType($type);
        }
    }

    public function create(string $typeId): UnitInterface
    {
        $type = $this->getUnitTypeById($typeId);

        return new Unit($type);
    }

    public function getUnitTypeById(string $id)
    {
        return $this->types[$id];
    }

    protected function addType(UnitTypeInterface $type)
    {
        $this->types[$type->getId()] = $type;
    }
}