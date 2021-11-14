<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

class IncludeFile extends Lazy
{
    /**
     * @var Lazy|string
     */
    protected $file;

    /**
     * @param string|Lazy $file
     */
    public function __construct(
        $file
    ) {
        $this->file = $file;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container)
    {
        $file = static::resolveArgument($container, $this->file);
        return include $file;
    }
}
