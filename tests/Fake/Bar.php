<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

use stdClass;

class Bar
{
    public stdClass $arg0;
    public Foo $arg1;
    public string $arg2 = 'default_value';

    public function __construct(
        stdClass $arg0,
        Foo $arg1,
        string $arg2 = 'default_value'
    ) {
        $this->arg2 = $arg2;
        $this->arg1 = $arg1;
        $this->arg0 = $arg0;
    }
}
