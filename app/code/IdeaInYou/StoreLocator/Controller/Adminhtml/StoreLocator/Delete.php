<?php
namespace IdeaInYou\StoreLocator\Controller\Adminhtml\StoreLocator;

use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use IdeaInYou\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;

/**
 * Class MassDelete
 */
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var StoreLocatorRepositoryInterface $storeLocatorRepository
     */
    private StoreLocatorRepositoryInterface $storeLocatorRepository;

    /**
     * @param Context $context
     * @param StoreLocatorRepositoryInterface $storeLocatorRepository
     */
    public function __construct(
        Context $context,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        parent::__construct($context);
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $storeLocatorId = $this->getRequest()->getParam('id');

        if ($storeLocatorId) {
            try {
                $this->storeLocatorRepository->deleteById($storeLocatorId);
                $this->messageManager->addSuccessMessage(__('StoreLocator Id %s have been deleted.', $storeLocatorId));
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getLogMessage());
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
