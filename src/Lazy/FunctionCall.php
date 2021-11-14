<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

class FunctionCall extends Lazy
{
    protected string $function;
    protected array $arguments;

    public function __construct(
        string $function,
        array $arguments
    ) {
        $this->arguments = $arguments;
        $this->function = $function;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container)
    {
        $arguments = static::resolveArguments($container, $this->arguments);
        return call_user_func($this->function, ...$arguments);
    }
}
