<?php
namespace Custom\ImageOptimization\Controller\Adminhtml\Unlink;
use Magento\Framework\App\RequestInterface;

class Update extends \Magento\Backend\App\Action
{

    public function execute()
    {
        $unlink = "php bin/magento custom:product:unlink";
        exec($unlink);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customoptimization/unlink/index');

        return $resultRedirect;
    }

}
?>