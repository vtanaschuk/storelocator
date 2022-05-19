<?php

namespace IdeaInYou\StoreLocator\Block;

use IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator as ResourceStoreLocator;
use IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use IdeaInYou\StoreLocator\Model\StoreLocatorFactory;
use IdeaInYou\StoreLocator\Model\StoreLocatorRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

class Hello extends \Magento\Framework\View\Element\Template
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
        array               $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
    }

    protected function _prepareLayout(): Hello
    {
        $this->pageConfig->getTitle()->set('My Title');
        return parent::_prepareLayout();
    }

    public function getHelloMessage(): string
    {
        return 'hello from block';
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
        $storeLocator
            ->setName('Hello')
            ->setComment('Comment Hello' . time())
            ->setLatitude(111111)
            ->setLongitude(222222)
            ->setProductId(2);
        $storeLocator->save();
    }
}
