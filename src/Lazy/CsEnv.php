<?php
declare(strict_types=1);

namespace Capsule\Di\Lazy;

use Capsule\Di\Container;
use Capsule\Di\Exception\NotDefined;

class CsEnv extends Env
{
    /**
     * @param Container $container
     * @return mixed
     * @throws NotDefined
     */
    public function __invoke(Container $container)
    {
        $values = str_getcsv($this->getEnv());

        if ($this->vartype !== null) {
            foreach ($values as &$value) {
                settype($value, $this->vartype);
            }
        }

        return $values;
    }
}
