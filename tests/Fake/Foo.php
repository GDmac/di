<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

class Foo implements FooInterface
{
    public string $arg1;
    public string $arg2 = 'val2';

    public function __construct(
        string $arg1,
        string $arg2 = 'val2'
    ) {
        $this->arg2 = $arg2;
        $this->arg1 = $arg1;
    }

    public function append(string $suffix) : void
    {
        $this->arg1 .= $suffix;
    }

    public function getValue() : string
    {
        return $this->arg2;
    }

    public static function staticFake(string $word) : string
    {
        return $word;
    }
}
