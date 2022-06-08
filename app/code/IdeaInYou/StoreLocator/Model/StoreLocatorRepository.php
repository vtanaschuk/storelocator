<?php

namespace IdeaInYou\StoreLocator\Model;

use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator as ResourceStoreLocator;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class StoreLocatorRepository implements StoreLocatorRepositoryInterface
{
    /**
     * @var StoreLocatorFactory
     */
    private StoreLocatorFactory $storeLocatorFactory;

    /**
     * @var ResourceStoreLocator
     */
    private ResourceStoreLocator $resource;

    /**
     * @param StoreLocatorFactory $storeLocatorFactory
     * @param ResourceStoreLocator $resource
     */
    public function __construct(
        StoreLocatorFactory $storeLocatorFactory,
        ResourceStoreLocator $resource
    ) {
        $this->resource = $resource;
        $this->storeLocatorFactory = $storeLocatorFactory;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $storeLocator = $this->storeLocatorFactory->create();
        $this->resource->load($storeLocator, $id);
        if (!$storeLocator->getId()) {
            throw new NoSuchEntityException(__('StoreLocator with id "%1" does not exist.', $id));
        }
        return $storeLocator;
    }

    /**
     * @param StoreLocator $storeLocator
     * @return StoreLocator
     * @throws CouldNotSaveException
     */
    public function save(StoreLocator $storeLocator): StoreLocator
    {
        try {
            $this->resource->save($storeLocator);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the storeLocator: %1',
                $exception->getMessage()
            ));
        }
        return $storeLocator;
    }

    public function delete(StoreLocator $storeLocator)
    {
        try {

            $this->resource->delete($storeLocator);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the StoreLocator: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }
}
