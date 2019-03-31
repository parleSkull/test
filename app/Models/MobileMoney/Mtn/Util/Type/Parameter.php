<?php

namespace App\Models\MobileMoney\Mtn\Util\Type;

class Parameter
{

    /**
     * @var string
     */
    private $name = null;

    /**
     * @var string
     */
    private $value = null;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Parameter
     */
    public function withName($name)
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Parameter
     */
    public function withValue($value)
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }


}

