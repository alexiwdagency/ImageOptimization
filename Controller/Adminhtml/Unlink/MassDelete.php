<?php
namespace Custom\ImageOptimization\Controller\Adminhtml\Unlink;

use Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\ObjectManager;
use \Magento\Framework\App\Filesystem\DirectoryList;

class MassDelete extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;
    protected $request;
    protected $filter;
    protected $separate = DIRECTORY_SEPARATOR;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        RequestInterface $request
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
        parent::__construct($context);
    }


    public function execute()
    {
        $objectManager = $this->getInstance();
        $filter = $objectManager->get('\Magento\Ui\Component\MassAction\Filter');
        $unlink = $objectManager->get('\Custom\ImageOptimization\Model\ResourceModel\Unlink\CollectionFactory');
        $collection = $this->getInstance()->get('\Custom\ImageOptimization\Model\Unlink');
        $filesystem = $objectManager->get('Magento\Framework\Filesystem');
        $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);

        $filter = $filter->getCollection($unlink->create());

        foreach ($filter as $item){
            if($collection->load($item->getId())){
                $path = $collection->getPath();
                $fullPath = $directory->getAbsolutePath() . 'catalog' . DIRECTORY_SEPARATOR . 'product'.$path;
                if($this->separate == "\\"){
                    $fullPath = str_replace('/',$this->separate,$fullPath);
                }
                if(file_exists($fullPath)){
                    unlink($fullPath);
                }
                $collection->delete();
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customoptimization/unlink/index');

        return $resultRedirect;
    }

    public function getInstance(){
        return ObjectManager::getInstance();
    }

}
?>