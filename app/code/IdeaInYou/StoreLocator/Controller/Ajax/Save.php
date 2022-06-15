<?php

namespace IdeaInYou\StoreLocator\Controller\Ajax;

use IdeaInYou\StoreLocator\Api\StoreLocatorRepositoryInterface;
use IdeaInYou\StoreLocator\Helper\Data;
use IdeaInYou\StoreLocator\Model\StoreLocatorFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json as ResultJson;
use Magento\Framework\Controller\Result\JsonFactory as ResultJsonFactory;
use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;


/**
 * Class Save
 */
class Save implements HttpGetActionInterface
{
    /**
     * @var JsonSerializer
     */
    private JsonSerializer $jsonSerializer;
    /**
     * @var ResultJsonFactory
     */
    private ResultJsonFactory $resultJsonFactory;
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    private Data $data;
    private StoreLocatorFactory $storeLocatorFactory;
    private StoreLocatorRepositoryInterface $storeLocatorRepository;


    public function __construct(
        JsonSerializer $jsonSerializer,
        ResultJsonFactory $resultJsonFactory,
        RequestInterface $request,
        StoreLocatorFactory $storeLocatorFactory,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        $this->jsonSerializer = $jsonSerializer;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    /**
     * @return ResultJson
     */
    public function execute()
    {
        if (!$this->request->isAjax()) {
            $data = [
                'success' => false,
                'error_message' => __('This is not $.ajax')
            ];

            return $this->resultJsonFactory->create()->setData($data);
        }

        try {
            $requestData = $this->request->getParams();

            $storeLocator = $this->storeLocatorFactory->create();
            $storeLocator->setData($requestData);

            $this->storeLocatorRepository->save($storeLocator);

            $data = [
                'success' => true,
                'error_message' => '',
                'data'=>$requestData
            ];
        } catch (\Exception $ex) {
            $data = [
                'success' => false,
                'error_message' => $ex->getMessage()
            ];
        }

        return $this->resultJsonFactory->create()->setData($data);
    }
}
