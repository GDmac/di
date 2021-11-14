<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

class Get extends Lazy
{
    /**
     * @var Lazy|string
     */
    protected $id;

    /**
     * @param string|Lazy $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container)
    {
        $id = static::resolveArgument($container, $this->id);
        return $container->get($id);
    }
}
