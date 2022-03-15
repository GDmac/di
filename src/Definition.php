<?php
declare(strict_types=1);

namespace Capsule\Di;

use Capsule\Di\Lazy\Lazy;
use Throwable;

abstract class Definition extends Lazy
{
    protected string $id;

    protected ?string $class = null;

    /**
     * @var callable|null
     */
    protected /* callable */ $factory = null;

    protected bool $isInstantiable = false;

    /**
     * @param Container $container
     * @return object
     */
    public function __invoke(Container $container) : object
    {
        return $this->new($container);
    }

    public function factory(callable $factory) : self
    {
        $this->factory = $factory;
        return $this;
    }

    public function isInstantiable(Container $container) : bool
    {
        if ($this->factory !== null) {
            return true;
        }

        if ($this->class !== null) {
            return $container->has($this->class);
        }

        return $this->isInstantiable;
    }

    public function new(Container $container) : object
    {
        try {
            return $this->instantiate($container);
        } catch (Throwable $e) {
            throw new Exception\NotInstantiated("Could not instantiate {$this->id}", 0, $e);
        }
    }

    abstract protected function instantiate(Container $container) : object;
}
