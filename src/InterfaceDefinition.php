<?php
declare(strict_types=1);

namespace Capsule\Di;

use Capsule\Di\Lazy\Lazy;

class InterfaceDefinition extends Definition
{
    protected ?string $class = null;
    protected string $id;

    /**
     * @throws Exception\NotFound
     */
    public function __construct(string $id)
    {
        $this->id = $id;
        if (! interface_exists($id)) {
            throw new Exception\NotFound("Interface '{$id}' not found.");
        }
    }

    /**
     * @throws Exception\NotFound
     */
    public function class(string $class) : self
    {
        if (! class_exists($class)) {
            throw new Exception\NotFound("Class '{$class}' not found.");
        }

        $this->class = $class;
        return $this;
    }

    /**
     * @throws Exception\NotDefined
     */
    public function instantiate(Container $container) : object
    {
        if ($this->factory !== null) {
            $factory = Lazy::resolveArgument($container, $this->factory);

            if (!is_callable($factory, true)) {
                throw new \Exception('not a callable');
            }

            return $factory($container);
        }

        if ($this->class !== null) {
            $object = $container->new($this->class);
            if (! is_object($object)) {
                throw new \Exception('class is not valid');
            }
            return $object;
        }

        throw new Exception\NotDefined(
            "Class/factory for interface definition '{$this->id}' not set."
        );
    }
}
