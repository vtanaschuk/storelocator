<?php

namespace IdeaInYou\StoreLocator\Model;

use IdeaInYou\StoreLocator\Api\StoreLocatorInterface;
use Magento\Framework\DataObject\IdentityInterface;

class StoreLocator extends \Magento\Framework\Model\AbstractModel implements StoreLocatorInterface, IdentityInterface
{
    protected $_eventPrefix = 'ideainyou_storelocator';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator::class);
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    public function getName()
    {
        return parent::getData(self::STORE_NAME);
    }

    public function setName($name): StoreLocator
    {
        return $this->setData(self::STORE_NAME, $name);
    }

    public function getStoreDescription()
    {
        return parent::getData(self::STORE_NAME);
    }

    public function setStoreDescription($description): StoreLocator
    {
        return $this->setData(self::STORE_DESCRIPTION, $description);
    }

    public function getStoreCountry()
    {
        return parent::getData(self::STORE_COUNTRY);
    }

    public function setStoreCountry($country): StoreLocator
    {
        return $this->setData(self::STORE_COUNTRY, $country);
    }

    public function getStoreCity()
    {
        return parent::getData(self::STORE_CITY);
    }

    public function setStoreCity($city): StoreLocator
    {
        return $this->setData(self::STORE_CITY, $city);
    }

    public function getStoreState()
    {
        return parent::getData(self::STORE_CITY);
    }

    public function setStoreState($state): StoreLocator
    {
        return $this->setData(self::STORE_STATE, $state);
    }

    public function getStoreAddress()
    {
        return parent::getData(self::STORE_ADDRESS);
    }

    public function setStoreAddress($address): StoreLocator
    {
        return $this->setData(self::STORE_ADDRESS, $address);
    }

    public function getStorePost()
    {
        return parent::getData(self::STORE_POST);
    }

    public function setStorePost($post): StoreLocator
    {
        return $this->setData(self::STORE_POST, $post);
    }

    public function getLatitude()
    {
        return parent::getData(self::STORE_LATITUDE);
    }

    public function setLatitude($latitude): StoreLocator
    {
        return $this->setData(self::STORE_LATITUDE, $latitude);
    }

    public function getLongitude()
    {
        return parent::getData(self::STORE_LONGITUDE);
    }

    public function setLongitude($longitude): StoreLocator
    {
        return $this->setData(self::STORE_LONGITUDE, $longitude);
    }

    public function getApproved()
    {
        return parent::getData(self::IS_APPROVED);
    }

    public function setApproved($status): StoreLocator
    {
        return $this->setData(self::IS_APPROVED, $status);
    }

    public function getIdentities()
    {
        // TODO: Implement getIdentities() method.
    }
}
