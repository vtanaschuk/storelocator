<?php
namespace IdeaInYou\StoreLocator\Controller\Adminhtml\StoreLocator;

use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use IdeaInYou\StoreLocator\Model\StoreLocatorFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Registry;

/**
 * Save CMS block action.
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    private $_coreRegistry;
    private $storeLocatorFactory;
    private $storeLocatorRepository;

    public function __construct(
        Context $context,
        Registry $_coreRegistry,
        DataPersistorInterface $dataPersistor,
        StoreLocatorFactory $storeLocatorFactory = null,
        StoreLocatorRepositoryInterface $storeLocatorRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->storeLocatorFactory = $storeLocatorFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(StoreLocatorFactory::class);
        $this->storeLocatorRepository = $storeLocatorRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(StoreLocatorRepositoryInterface::class);
        parent::__construct($context);
        $this->_coreRegistry = $_coreRegistry;
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {

            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->storeLocatorFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->storeLocatorRepository->getById($id);
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage(__('This store no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->storeLocatorRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the store.'));
                $this->dataPersistor->clear('ideainyou_storelocator');
                return $this->processBlockReturn($model, $data, $resultRedirect);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            $this->dataPersistor->set('ideainyou_storelocator', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

//    public function

    /**
     * Process and set the block return
     *
     * @param \Magento\Cms\Model\Block $model
     * @param array $data
     * @param \Magento\Framework\Controller\ResultInterface $resultRedirect
     * @return \Magento\Framework\Controller\ResultInterface
     */
    private function processBlockReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
        } elseif ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect;
    }
}
