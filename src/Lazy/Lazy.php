<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

abstract class Lazy
{
    static public function resolveArguments(
        Container $container,
        array $arguments
    ) : array
    {
        foreach ($arguments as &$argument) {
            $argument = static::resolveArgument($container, $argument);
        }

        return $arguments;
    }

    /**
     * @param Container $container
     * @param mixed $argument
     * @return mixed
     */
    static public function resolveArgument(
        Container $container,
        $argument
    )
    {
        if ($argument instanceof Lazy) {
            return $argument($container);
        }

        return $argument;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    abstract public function __invoke(Container $container);
}
