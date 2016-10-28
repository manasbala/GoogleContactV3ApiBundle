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
    private $firstName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $homeEmail;

    /**
     * @var string
     */
    private $workEmail;

    /**
     * @var array
     */
    private $otherEmails = array();

    /**
     * @var string
     */
    private $homePhone;

    /**
     * @var string
     */
    private $workPhone;

    /**
     * @var array
     */
    private $otherPhones;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @return Contact
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

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
    public function getOtherEmails()
    {
        return $this->otherEmails;
    }

    /**
     * @param array $otherEmails
     * @return Contact
     */
    public function setOtherEmails($otherEmails)
    {
        $this->otherEmails = $otherEmails;
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
    public function getOtherPhones()
    {
        return $this->otherPhones;
    }

    /**
     * @param array $otherPhones
     * @return Contact
     */
    public function setOtherPhones($otherPhones)
    {
        $this->otherPhones = $otherPhones;
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
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Contact
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return Contact
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Contact
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Contact
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
}