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
            return $factory($container);
        }

        if ($this->class !== null) {
            return $container->new($this->class);
        }

        throw new Exception\NotDefined(
            "Class/factory for interface definition '{$this->id}' not set."
        );
    }
}
