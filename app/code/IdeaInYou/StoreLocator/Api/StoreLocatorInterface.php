<?php

namespace IdeaInYou\StoreLocator\Api;

interface StoreLocatorInterface
{
    const TABLE_NAME = 'ideainyou_storelocator';
    const ENTITY_ID = 'entity_id';
    const STORE_NAME = 'storeName';
    const STORE_DESCRIPTION ='description';
    const STORE_COUNTRY = 'country';
    const STORE_CITY = 'city';
    const STORE_STATE ='state';
    const STORE_POST ='post';
    const STORE_LATITUDE = 'latitude';
    const STORE_LONGITUDE = 'longitude';
    const IS_APPROVED = 'is_approved';

    /**
     * @return mixed
     */
    public function getId();

    public function setId($id);

    public function getName();

    public function setName($name);

    public function getStoreDescription();

    public function setStoreDescription($description);

    public function getStoreCountry();

    public function setStoreCountry($country);

    public function getStoreCity();

    public function setStoreCity($city);

    public function getStoreState();

    public function setStoreState($state);

    public function getStorePost();

    public function setStorePost($post);

    public function getLatitude();

    public function setLatitude($latitude);

    public function getLongitude();

    public function setLongitude($longitude);

    public function getApproved();

    public function setApproved($status);
}
