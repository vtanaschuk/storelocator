<?php
namespace IdeaInYou\StoreLocator\Model\ResourceModel;

use IdeaInYou\StoreLocator\Api\StoreLocatorInterface;

class StoreLocator extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var bool
     */
    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init(StoreLocatorInterface::TABLE_NAME, StoreLocatorInterface::ENTITY_ID);
        $this->_useIsObjectNew = true;
    }
}
