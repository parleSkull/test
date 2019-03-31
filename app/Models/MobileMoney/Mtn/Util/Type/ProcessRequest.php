<?php

namespace App\Models\MobileMoney\Mtn\Util\Type;

use IteratorAggregate;
use Phpro\SoapClient\Type\RequestInterface;
use Traversable;

class ProcessRequest implements RequestInterface, IteratorAggregate
{

    /**
     * @var int
     */
    private $serviceId = null;

    /**
     * @var \App\Models\MobileMoney\Mtn\Util\Type\Parameter[]
     */
    private $parameter = null;

    /**
     * Constructor
     *
     * @var int $serviceId
     * @var \App\Models\MobileMoney\Mtn\Util\Type\Parameter[] $parameter
     */
    public function __construct($serviceId, array $parameter)
    {
        $this->serviceId = $serviceId;
        $this->parameter = $parameter;
    }

    /**
     * @return int
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param int $serviceId
     * @return ProcessRequest
     */
    public function withServiceId($serviceId)
    {
        $new = clone $this;
        $new->serviceId = $serviceId;

        return $new;
    }

    /**
     * @return \App\Models\MobileMoney\Mtn\Util\Type\Parameter[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param \App\Models\MobileMoney\Mtn\Util\Type\Parameter[] $parameter
     * @return ProcessRequest
     */
    public function withParameter(array $parameter)
    {
        $new = clone $this;
        $new->parameter = $parameter;

        return $new;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayIterator(is_array($this->parameter) ? $this->parameter : []);
    }
}

