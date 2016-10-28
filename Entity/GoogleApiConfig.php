<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/25/16
 * Time: 20:44
 */

namespace MB\GoogleContactV3ApiBundle\Entity;

/**
 * GoogleApiConfig
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GoogleApiConfig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=255)
     */
    protected $key;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    protected $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return GoogleApiConfig
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
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
     * @return GoogleApiConfig
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return GoogleApiConfig
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GoogleApiConfig
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}