<?php

namespace IdeaInYou\StoreLocator\Plugin;

class StoreLocatorApi
{
    public function beforeSave($subject)
    {
        var_dump($subject);
        die();
    }
}
