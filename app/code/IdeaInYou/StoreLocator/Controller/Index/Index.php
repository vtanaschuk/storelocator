<?php

namespace IdeaInYou\StoreLocator\Controller\Index;

use IdeaInYou\StoreLocator\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action implements HttpGetActionInterface
{
    private Data $data;

    public function __construct(
        Context $context,
        Data $data
    ) {
        parent::__construct($context);
        $this->data = $data;
    }

    public function execute()
    {

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
