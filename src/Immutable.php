<?php

declare(strict_types=1);

namespace PhpDsImmutable;

interface Immutable
{
    public function __set(string $name, $value): void;
    public function __unset(string $name): void;
}
