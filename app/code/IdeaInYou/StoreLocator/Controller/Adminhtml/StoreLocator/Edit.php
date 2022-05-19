<?php

namespace IdeaInYou\StoreLocator\Controller\Adminhtml\StoreLocator;

use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use IdeaInYou\StoreLocator\Model\StoreLocatorFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\TestFramework\Exception\NoSuchActionException;

/**
 * Edit CMS block action.
 */
class Edit extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    protected \Magento\Framework\View\Result\PageFactory $resultPageFactory;
    private Registry $_coreRegistry;
    private StoreLocatorFactory $storeLocatorFactory;
    private StoreLocatorRepositoryInterface $storeLocatorRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        StoreLocatorFactory $storeLocatorFactory,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Magento\Cms\Model\Block::class);

        // 2. Initial checking
        if ($id) {
            try {
                $model = $this->storeLocatorRepository->getById($id);
            } catch (NoSuchActionException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            $model = $this->storeLocatorFactory->create();
        }

        $this->_coreRegistry->register('ideainyou_storelocator', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('StoreLocator'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('StoreLocator: %1', $model->getId()) : __('New StoreLocator'));
        return $resultPage;
    }
}
