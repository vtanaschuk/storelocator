<?php

namespace IdeaInYou\StoreLocator\Observer;

use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use IdeaInYou\StoreLocator\Model\StoreLocatorFactory;
use Magento\Sales\Model\Order;

class PlaceOrder implements \Magento\Framework\Event\ObserverInterface
{
    private StoreLocatorFactory $storeLocatorFactory;
    private StoreLocatorRepositoryInterface $storeLocatorRepository;

    public function __construct(
        StoreLocatorFactory $storeLocatorFactory,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var Order $order $order */
        $order = $observer->getData('order');

//        $store = $this->storeLocatorFactory->create()
//            ->setStoreDescription('norm market')
//            ->setStoreCountry('Ukraine')
//            ->setStoreState('Bukovina')
//            ->setStoreCity('Zastavna')
//            ->setStorePost('58000');

//        $this->storeLocatorRepository->save($store);

        return $this;
    }
}
