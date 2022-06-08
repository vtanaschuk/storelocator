<?php

namespace IdeaInYou\StoreLocator\Plugin;

class StoreLocatorApi
{
    public function beforeSave($subject)
    {
        return $subject;
    }
}
