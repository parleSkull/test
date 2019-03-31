<?php

namespace App\Models\MobileMoney\Mtn\Util\Type;

use IteratorAggregate;
use Phpro\SoapClient\Type\RequestInterface;
use Phpro\SoapClient\Type\ResultInterface;
use Traversable;

class ProcessRequestResponse implements RequestInterface, ResultInterface, IteratorAggregate
{

    /**
     * @var \App\Models\MobileMoney\Mtn\Util\Type\Parameter[]
     */
    private $return = null;

    /**
     * Constructor
     *
     * @var \App\Models\MobileMoney\Mtn\Util\Type\Parameter[] $return
     */
    public function __construct($return)
    {
        $this->return = $return;
    }

    /**
     * @return \App\Models\MobileMoney\Mtn\Util\Type\Parameter[]
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param \App\Models\MobileMoney\Mtn\Util\Type\Parameter[] $return
     * @return ProcessRequestResponse
     */
    public function withReturn(array $return)
    {
        $new = clone $this;
        $new->return = $return;

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
        return new \ArrayIterator(is_array($this->return) ? $this->return : []);
    }
}

