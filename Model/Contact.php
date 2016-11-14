<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/25/16
 * Time: 19:53
 */

namespace MB\GoogleContactV3ApiBundle\Model;


class Contact
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $homeEmail;

    /**
     * @var string
     */
    private $workEmail;

    /**
     * @var string
     */
    private $otherEmail;

    /**
     * @var string
     */
    private $homePhone;

    /**
     * @var string
     */
    private $workPhone;

    /**
     * @var string
     */
    private $otherPhone;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $selfUrl;


    /**
     * @return string
     */
    public function getHomeEmail()
    {
        return $this->homeEmail;
    }

    /**
     * @param string $homeEmail
     * @return Contact
     */
    public function setHomeEmail($homeEmail)
    {
        $this->homeEmail = $homeEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkEmail()
    {
        return $this->workEmail;
    }

    /**
     * @param string $workEmail
     * @return Contact
     */
    public function setWorkEmail($workEmail)
    {
        $this->workEmail = $workEmail;
        return $this;
    }

    /**
     * @return array
     */
    public function getOtherEmail()
    {
        return $this->otherEmail;
    }

    /**
     * @param array $otherEmail
     * @return Contact
     */
    public function setOtherEmail($otherEmail)
    {
        $this->otherEmail = $otherEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * @param string $homePhone
     * @return Contact
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * @param string $workPhone
     * @return Contact
     */
    public function setWorkPhone($workPhone)
    {
        $this->workPhone = $workPhone;
        return $this;
    }

    /**
     * @return array
     */
    public function getOtherPhone()
    {
        return $this->otherPhone;
    }

    /**
     * @param array $otherPhone
     * @return Contact
     */
    public function setOtherPhone($otherPhone)
    {
        $this->otherPhone = $otherPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return Contact
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string
     */
    public function getSelfUrl()
    {
        return $this->selfUrl;
    }

    /**
     * @param string $selfUrl
     */
    public function setSelfUrl($selfUrl)
    {
        $this->selfUrl = $selfUrl;
    }
}