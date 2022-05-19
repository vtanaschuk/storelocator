<?php

namespace IdeaInYou\StoreLocator\Api;

use IdeaInYou\StoreLocator\Model\StoreLocator;

interface StoreLocatorRepositoryInterface
{
    public function getById($id);

    public function save(StoreLocator $storeLocator);

    public function delete(StoreLocator $storeLocator);

    public function deleteById($id);

}
