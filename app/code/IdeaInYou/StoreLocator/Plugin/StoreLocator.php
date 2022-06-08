<?php

namespace IdeaInYou\StoreLocator\Plugin;

use IdeaInYou\StoreLocator\Helper\Data;
use IdeaInYou\StoreLocator\Model\StoreLocatorRepository;

class StoreLocator
{
    private Data $data;

    public function __construct(
        Data $data
    ) {
        $this->data = $data;
    }
    /**
     * @param StoreLocatorRepository $subject
     * @param \IdeaInYou\StoreLocator\Model\StoreLocator $storeLocator
     * @return array
     */

    public function beforeSave(StoreLocatorRepository $subject, \IdeaInYou\StoreLocator\Model\StoreLocator $storeLocator): array
    {
        $apiKey     = $this->data->getApiKey();
        $country    = $storeLocator->getStoreCountry();
        $state      = $storeLocator->getStoreState();
        $city       = $storeLocator->getStoreCity();
        $address    = $storeLocator->getStoreAddress();
        $post       = $storeLocator->getStorePost();
        $fullAddress =  $country . ' ' . $post . ' ' . $state . ' ' . $city . ' ' . $address;

        $prepAddr = str_replace(' ', '+', $fullAddress);

        $url = "https://maps.google.com/maps/api/geocode/json?address=" . $prepAddr . "&key=" . $apiKey;
        $json = file_get_contents($url);
        $json = json_decode($json);

        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

        $storeLocator->setLatitude($lat);
        $storeLocator->setLongitude($long);


        return [$storeLocator];
    }
}
