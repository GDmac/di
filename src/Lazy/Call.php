<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

class Call extends Lazy
{
    /**
     * @var mixed
     */
    protected $callable;

    /**
     * @param mixed $callable
     */
    public function __construct(/* callable */ $callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container)
    {
        return ($this->callable)($container);
    }
}
