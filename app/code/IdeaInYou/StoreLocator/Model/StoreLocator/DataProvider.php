<?php
namespace IdeaInYou\StoreLocator\Model\StoreLocator;

use IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $storeLocatorCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $storeLocatorCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $storeLocatorCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $storeLocator) {
            $this->loadedData[$storeLocator->getId()] = $storeLocator->getData();
        }

        $data = $this->dataPersistor->get('ideainyou_storelocator');
        if (!empty($data)) {
            $storeLocator = $this->collection->getNewEmptyItem();
            $storeLocator->setData($data);
            $this->loadedData[$storeLocator->getId()] = $storeLocator->getData();
            $this->dataPersistor->clear('ideainyou_storelocator');
        }

        return $this->loadedData;
    }
}
