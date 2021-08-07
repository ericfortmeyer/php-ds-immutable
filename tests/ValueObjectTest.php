<?php

use PhpDsImmutable\ValueObject;
use PHPUnit\Framework\TestCase;

class ValueObjectTest extends TestCase
{
    public function wrappedValueProvider(): array
    {
        return array_map(
            fn ($value) => [$value], 
            [
                "object"  => (object)"",
                "closure" => fn () => null,
                "string"  => base64_encode(random_bytes(8)),
                "float"   => array_rand(range(-10e6, 10e6)),
                "null"    => null,
                "int"     => random_int(PHP_INT_MIN, PHP_INT_MAX) 
            ]
        );
    }
    public function testMagicSetterThrowsException()
    {
        $this->expectException(Exception::class);

        $sut = new class(null) extends ValueObject {};

        $sut->nonExistentProperty = null;
    }
    
    public function testMagicUnsetterThrowsException()
    {
        $this->expectException(Exception::class);

        $sut = new class(null) extends ValueObject {};

        unset($sut->nonExistentProperty);
    }

    /**
     * @dataProvider wrappedValueProvider
     */
    public function testGetsTheWrappedValue($valueToWrap)
    {
        $sut = new class($valueToWrap) extends ValueObject {};
        $this->assertEquals($valueToWrap, $sut->value());
    }
}
