<?php

declare(strict_types=1);

namespace PhpDsImmutable;

use Exception;

abstract class ValueObject implements Immutable
{
    private const IMMUTABLE_OBJECT = "immutable object";

    public function __construct(protected mixed $value)
    {
        
    }

    public function value(): mixed
    {
        return $this->value;
    }

    final public function __set(string $name, mixed $value): void
    {
        throw new Exception(self::IMMUTABLE_OBJECT);
    }

    final public function __unset(string $name): void
    {
        throw new Exception(self::IMMUTABLE_OBJECT);
    }
}
