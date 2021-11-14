<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

use stdClass;

class Irk
{
    public stdClass $arg0;
    public string $arg1;
    public string $arg2 = 'arg2-default';

    public function __construct(
        stdClass $arg0,
        string $arg1,
        string $arg2 = 'arg2-default'
    ) {
        $this->arg2 = $arg2;
        $this->arg1 = $arg1;
        $this->arg0 = $arg0;
    }
}
