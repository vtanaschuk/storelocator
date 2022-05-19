<?php

namespace IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator;

use IdeaInYou\StoreLocator\Model\StoreLocator;
use Magento\Framework\Event\ManagerInterface;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, ManagerInterface $eventManager, \Magento\Framework\DB\Adapter\AdapterInterface $connection = null, \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null)
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            StoreLocator::class,
            \IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator::class
        );
    }
}
