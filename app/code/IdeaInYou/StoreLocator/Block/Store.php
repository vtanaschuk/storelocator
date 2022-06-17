<?php

namespace IdeaInYou\StoreLocator\Block;

use IdeaInYou\StoreLocator\Helper\Data;
use IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use IdeaInYou\StoreLocator\Model\StoreLocatorFactory;
use IdeaInYou\StoreLocator\Model\StoreLocatorRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

class Store extends \Magento\Framework\View\Element\Template
{

    /**
     * @var StoreLocatorFactory
     */
    private $storeLocatorFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CollectionFactory
     */
    private $storeLocatorRepository;

    private Data $dataApi;

    /**
     * @param StoreLocatorFactory $storeLocatorFactory
     * @param CollectionFactory $collectionFactory
     * @param StoreLocatorRepository $storeLocatorRepository
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        StoreLocatorFactory $storeLocatorFactory,
        CollectionFactory $collectionFactory,
        StoreLocatorRepository $storeLocatorRepository,
        Template\Context    $context,
        Data $dataApi,
        array               $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->dataApi = $dataApi;
    }

    protected function _prepareLayout(): Store
    {

        $this->pageConfig->getTitle()->set('Store Locator');
        return parent::_prepareLayout();
    }

    public function getStoreLocatorCollection(): \IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator\Collection
    {
        return $this->collectionFactory->create();
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getStoreLocatorById($storeLocatorId): \IdeaInYou\StoreLocator\Model\StoreLocator
    {
        return $this->storeLocatorRepository->getById($storeLocatorId);
    }

    /**
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function createStoreLocator()
    {

        $storeLocator = $this->storeLocatorFactory->create();
//        $storeLocator
//            ->setName('Hello')
//            ->setComment('Comment Hello' . time())
//            ->setLatitude(111111)
//            ->setLongitude(222222)
//            ->setProductId(2);
//        $storeLocator->save();

//        $collection = $this->collectionFactory->create()
//            ->addFieldToFilter('is_approved', ['eq'=>'1']);
//        var_dump($collection->getData());
//        die();
    }

    public function getApi()
    {
        return $this->dataApi->getApiKey();
    }
}
