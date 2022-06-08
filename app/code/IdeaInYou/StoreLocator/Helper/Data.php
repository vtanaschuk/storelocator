<?php

namespace IdeaInYou\StoreLocator\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const ENABLE_KEY_PATH = 'storeLocator/general/enable';
    const API_KEY_PATH = 'storeLocator/general/google_api';

    public function getApiKey(): string
    {
        return $this->scopeConfig->getValue(
            self::API_KEY_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getEnabled(): bool
    {
        return (bool) $this->scopeConfig->getValue(
            self::ENABLE_KEY_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
