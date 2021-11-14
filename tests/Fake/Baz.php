<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

use stdClass;

class Baz
{
    public stdClass $std;

    public function __construct(
        stdClass $std
    ) {
        $this->std = $std;
    }
}
