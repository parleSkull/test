<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3/24/2019
 * Time: 02:26
 */

namespace App\Models\MobileMoney\Mtn\Util\Type;

class RequestSoapHeader
{
    /**
     * @var string
     */
    protected $spId;

    /**
     * @var string
     */
    protected $spPassword;

    /**
     * @var string
     */
    protected $serviceId;

    /**
     * @var string
     */
    protected $bundleID;

    /**
     * @var string
     */
    protected $timeStamp;


    public function __construct(string $spId, string $spPassword, string $serviceId, string $bundleID, string $timeStamp)
    {
        $this->spId = $spId;
        $this->spPassword = $spPassword;
        $this->serviceId = $serviceId;
        $this->bundleID = $bundleID;
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return string
     */
    public function getSpId(): string
    {
        return $this->spId;
    }

    /**
     * @param string $spId
     */
    public function setSpId(string $spId): void
    {
        $this->spId = $spId;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     */
    public function setServiceId(string $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getBundleID(): string
    {
        return $this->bundleID;
    }

    /**
     * @param string $bundleID
     */
    public function setBundleID(string $bundleID): void
    {
        $this->bundleID = $bundleID;
    }

    /**
     * @return string
     */
    public function getSpPassword(): string
    {
        return $this->spPassword;
    }

    /**
     * @param string $spPassword
     */
    public function setSpPassword(string $spPassword): void
    {
        $this->spPassword = $spPassword;
    }

    /**
     * @return string
     */
    public function getTimeStamp(): string
    {
        return $this->timeStamp;
    }

    /**
     * @param string $timeStamp
     */
    public function setTimeStamp(string $timeStamp): void
    {
        $this->timeStamp = $timeStamp;
    }

}