<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;
use Capsule\Di\Exception;

class Env extends Lazy
{
    protected string $varname;
    protected ?string $vartype = null;

    /**
     * @param string $varname
     * @param string|null $vartype
     */
    public function __construct(
        string $varname,
        ?string $vartype = null
    ) {
        $this->vartype = $vartype;
        $this->varname = $varname;
    }

    /**
     * @param Container $container
     * @return mixed
     * @throws Exception\NotDefined
     */
    public function __invoke(Container $container)
    {
        $value = $this->getEnv();

        if ($this->vartype !== null) {
            settype($value, $this->vartype);
        }

        return $value;
    }

    /**
     * @return string
     * @throws Exception\NotDefined
     */
    protected function getEnv() : string
    {
        $env = getenv();

        if (! array_key_exists($this->varname, $env)) {
            throw new Exception\NotDefined(
                "Evironment variable '{$this->varname}' is not defined."
            );
        }

        return $env[$this->varname];
    }
}
