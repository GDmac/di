<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

class NewCall extends Lazy
{
    /**
     * @var Lazy|string
     */
    protected $id;

    protected string $method;

    protected array $arguments;

    /**
     * @param string|Lazy $id
     * @param string $method
     * @param array $arguments
     */
    public function __construct(
        $id,
        string $method,
        array $arguments
    ) {
        $this->arguments = $arguments;
        $this->method = $method;
        $this->id = $id;
    }

    /**
     * @param Container $container
     * @return mixed
     */
    public function __invoke(Container $container)
    {
        $id = static::resolveArgument($container, $this->id);
        $arguments = static::resolveArguments($container, $this->arguments);
        return $container->new($id)->{$this->method}(...$arguments);
    }
}
