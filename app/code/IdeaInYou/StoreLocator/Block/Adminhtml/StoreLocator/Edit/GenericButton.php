<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace IdeaInYou\StoreLocator\Block\Adminhtml\StoreLocator\Edit;

use Magento\Backend\Block\Widget\Context;
use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    private StoreLocatorRepositoryInterface $storeLocatorRepository;

    public function __construct(
        Context $context,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        $this->context = $context;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    /**
     * Return CMS block ID
     *
     * @return int|null
     */
    public function getStoreLocatorId()
    {
        try {
            return $this->storeLocatorRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
