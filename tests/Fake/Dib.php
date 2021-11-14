<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

class Dib
{
    public ?Foo $arg0;
    public ?Foo $arg1 = null;

    public function __construct(
        ?Foo $arg0,
        ?Foo $arg1 = null
    ) {
        $this->arg1 = $arg1;
        $this->arg0 = $arg0;
    }
}
