<?php
declare(strict_types=1);

namespace Capsule\Di;

use Capsule\Di\Exception;
use Capsule\Di\Lazy\Lazy as AnyLazy;
use stdClass;

class Definitions extends stdClass
{
    /**
     * @param string $id
     * @return mixed
     * @throws Exception\NotFound
     */
    public function __get(string $id)
    {
        $definition = $this->newDefinition($id);

        if ($definition === null) {
            throw new Exception\NotFound("Value definition '$id' not found.");
        }

        $this->$id = $definition;
        return $this->$id;
    }

    /**
     * @throws Exception\NotFound
     */
    public function newDefinition(string $type) : ?Definition
    {
        if (interface_exists($type)) {
            return new InterfaceDefinition($type);
        }

        if (class_exists($type)) {
            return (new ClassDefinition($type))->inherit($this);
        }

        return null;
    }

    public function array(array $values = []) : Lazy\ArrayValues
    {
        return new Lazy\ArrayValues($values);
    }

    public function call(callable $callable) : Lazy\Call
    {
        return new Lazy\Call($callable);
    }

    /**
     * @param string|AnyLazy $id
     * @return Lazy\CallableGet
     */
    public function callableGet($id) : Lazy\CallableGet
    {
        return new Lazy\CallableGet($id);
    }

    /**
     * @param string|AnyLazy $id
     * @return Lazy\CallableNew
     */
    public function callableNew($id) : Lazy\CallableNew
    {
        return new Lazy\CallableNew($id);
    }

    public function csEnv(string $varname, string $vartype = null) : Lazy\CsEnv
    {
        return new Lazy\CsEnv($varname, $vartype);
    }

    public function env(string $varname, string $vartype = null) : Lazy\Env
    {
        return new Lazy\Env($varname, $vartype);
    }

    /**
     * @param string $function
     * @param mixed ...$arguments
     * @return Lazy\FunctionCall
     */
    public function functionCall(
        string $function,
        ...$arguments
    ) : Lazy\FunctionCall
    {
        return new Lazy\FunctionCall($function, $arguments);
    }

    /**
     * @param string|AnyLazy $id
     * @return Lazy\Get
     */
    public function get($id) : Lazy\Get
    {
        return new Lazy\Get($id);
    }

    /**
     * @param string|AnyLazy $class
     * @param string $method
     * @param mixed ...$arguments
     * @return Lazy\GetCall
     */
    public function getCall(
        $class,
        string $method,
        ...$arguments
    ) : Lazy\GetCall
    {
        return new Lazy\GetCall($class, $method, $arguments);
    }

    /**
     * @param string|AnyLazy $id
     * @return Lazy\NewInstance
     */
    public function new($id) : Lazy\NewInstance
    {
        return new Lazy\NewInstance($id);
    }

    /**
     * @param string|AnyLazy $class
     * @param string $method
     * @param mixed ...$arguments
     * @return Lazy\NewCall
     */
    public function newCall(
        $class,
        string $method,
        ...$arguments
    ) : Lazy\NewCall
    {
        return new Lazy\NewCall($class, $method, $arguments);
    }

    /**
     * @param string|AnyLazy $file
     * @return Lazy\IncludeFile
     */
    public function include(
        $file
    ) : Lazy\IncludeFile
    {
        return new Lazy\IncludeFile($file);
    }

    /**
     * @param string|AnyLazy $file
     * @return Lazy\RequireFile
     */
    public function require(
        $file
    ) : Lazy\RequireFile
    {
        return new Lazy\RequireFile($file);
    }

    /**
     * @param string|AnyLazy $class
     * @param string $method
     * @param mixed ...$arguments
     * @return Lazy\StaticCall
     */
    public function staticCall(
        $class,
        string $method,
        ...$arguments
    ) : Lazy\StaticCall
    {
        return new Lazy\StaticCall($class, $method, $arguments);
    }
}
