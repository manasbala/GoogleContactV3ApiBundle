<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/28/16
 * Time: 21:22
 */

namespace MB\GoogleContactV3ApiBundle\Entity;


use Doctrine\ORM\EntityRepository;

class GoogleApiConfigRepository extends EntityRepository
{
    /**
     * @param string $key
     * @return string
     */
    public function get($key)
    {
        $obj = $this->getEntityManager()->getRepository('MBGoogleContactV3ApiBundle:GoogleApiConfig')->findBy(
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

        $this->getEntityManager()->persist($obj);
        $this->getEntityManager()->flush($obj);

        return $obj;
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public function update($key, $value)
    {
        $obj = $this->getEntityManager()->getRepository('MBGoogleContactV3ApiBundle:GoogleApiConfig')->findBy(
            array(
                'key' =>$key
            )
        );

        if (!$obj) {
            $obj = $this->create($key, '');
        }

        $obj->setValue($value);

        $this->getEntityManager()->persist($obj);
        $this->getEntityManager()->flush($obj);

        return $obj->getValue();
    }
}