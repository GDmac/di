<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

function fake(string $word) : string
{
    return $word;
}

class FunctionCallTest extends LazyTest
{
    public function test_internal_function()
    {
        $lazy = new FunctionCall('stripos', ['0123x5678', 'x']);
        $actual = $lazy($this->container);
        $this->assertSame(4, $actual);
    }

    public function test()
    {
        $lazy = new FunctionCall('Capsule\Di\Lazy\fake', ['bar']);
        $actual = $this->actual($lazy);
        $this->assertSame('bar', $actual);
    }
}
