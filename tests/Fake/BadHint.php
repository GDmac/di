<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

use stdClass;

class BadHint
{
    private Nonesuch $nonesuch;

    public function __construct(
        Nonesuch $nonesuch
    ) {
        $this->nonesuch = $nonesuch;
    }
}
