<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/28/16
 * Time: 21:22
 */

namespace MB\GoogleContactV3ApiBundle\Manager;

use Doctrine\ORM\EntityManager;
use MB\GoogleContactV3ApiBundle\Entity\GoogleApiConfig;

class GoogleApiConfigManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get($key)
    {
        $obj = $this->em->getRepository('MBGoogleContactV3ApiBundle:GoogleApiConfig')->findOneBy(
            array('key' =>$key)
        );
        
        if (!$obj) {
            $obj = $this->create($key);
        }

        return $obj->getValue();
    }

    /**
     * @param string $key
     * @return GoogleApiConfig
     */
    public function create($key)
    {
        $obj = new GoogleApiConfig();
        $obj->setKey($key)
            ->setValue('')
            ->setCreated(new \DateTime());

        $this->em->persist($obj);
        $this->em->flush($obj);

        return $obj;
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public function update($key, $value)
    {
        $obj = $this->em->getRepository('MBGoogleContactV3ApiBundle:GoogleApiConfig')->findOneBy(
            array(
                'key' =>$key
            )
        );

        if (!$obj) {
            $obj = $this->create($key, '');
        }

        $obj->setValue($value);

        $this->em->persist($obj);
        $this->em->flush($obj);

        return $obj->getValue();
    }
}