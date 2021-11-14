<?php
declare(strict_types=1);

namespace Capsule\Di\Fake;

use stdClass;

class Zim
{
    /**
     * @var array|stdClass
     */
    public $union;

    /**
     * @param array|stdClass $union
     */
    public function __construct(
        $union
    ) {
        $this->union = $union;
    }
}
