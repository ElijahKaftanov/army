<?php declare(strict_types=1);

namespace App\Contract;


interface Identifiable
{
    public function getId(): string;
}