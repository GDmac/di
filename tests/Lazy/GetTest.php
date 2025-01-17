<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Exception;
use stdClass;

class GetTest extends LazyTest
{
    public function test()
    {
        $lazy = new Get(stdClass::CLASS);
        $get1 = $this->actual($lazy);
        $this->assertInstanceOf(stdClass::CLASS, $get1);

        $get2 = $this->actual($lazy);
        $this->assertInstanceOf(stdClass::CLASS, $get2);

        $this->assertSame($get1, $get2);
    }

    public function testNoSuchClass()
    {
        $lazy = new Get('NoSuchClass');
        $this->expectException(Exception\NotFound::CLASS);
        $this->expectExceptionMessage('NoSuchClass');
        $this->actual($lazy);
    }
}
