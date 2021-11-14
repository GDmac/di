<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

class StaticCall extends Lazy
{
    /**
     * @var Lazy|string
     */
    protected $class;
    protected string $method;
    protected array $arguments;

    /**
     * @param Lazy|string $class
     * @param string $method
     * @param array $arguments
     */
    public function __construct(
        $class,
        string $method,
        array $arguments
    ) {
        $this->arguments = $arguments;
        $this->method = $method;
        $this->class = $class;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container)
    {
        $class = static::resolveArgument($container, $this->class);
        $arguments = static::resolveArguments($container, $this->arguments);
        return call_user_func([$class, $this->method], ...$arguments);
    }
}
