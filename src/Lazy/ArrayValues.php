<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Countable;

class ArrayValues extends Lazy implements ArrayAccess, Countable, IteratorAggregate
{
    protected array $values = [];

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     * @param Container $container
     * @return array
     */
    public function __invoke(Container $container) : array
    {
        return $this->resolveValues($container, $this->values);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset) : bool
    {
        return array_key_exists($offset, $this->values);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->values[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) : void
    {
        if ($offset === null) {
            $this->values[] = $value;
        } else {
            $this->values[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset) : void
    {
        unset($this->values[$offset]);
    }

    public function count() : int
    {
        return count($this->values);
    }

    public function merge(iterable $values) : void
    {
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $this->values[] = $value;
            } else {
                $this->values[$key] = $value;
            }
        }
    }

    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->values);
    }

    protected function resolveValues(Container $container, array $values) : array
    {
        $return = [];

        foreach ($values as $key => $value) {
            $return[$key] = $this->resolveValue($container, $value);
        }

        return $return;
    }

    /**
     * @param Container $container
     * @param mixed $value
     * @return mixed
     */
    protected function resolveValue(Container $container, $value)
    {
        if ($value instanceof Lazy) {
            return $value($container);
        }

        if (is_array($value)) {
            return $this->resolveValues($container, $value);
        }

        return $value;
    }
}
