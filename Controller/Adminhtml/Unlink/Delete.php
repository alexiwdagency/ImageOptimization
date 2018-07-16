<?php
namespace Custom\ImageOptimization\Controller\Adminhtml\Unlink;
use Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\ObjectManager;
use \Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Setup\Exception;

class Delete extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;
    protected $request;
    protected $separate = DIRECTORY_SEPARATOR;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
    }


    public function execute()
    {
        $id = $this->request->getParam('id');
        $collection = $this->getInstance()->get('\Custom\ImageOptimization\Model\Unlink');

        try{
            if($collection->load($id)){
                $path = $collection->getPath();
                $objectManager = $this->getInstance();
                $filesystem = $objectManager->get('Magento\Framework\Filesystem');
                $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $fullPath = $directory->getAbsolutePath() . DIRECTORY_SEPARATOR . 'catalog' . DIRECTORY_SEPARATOR . 'product/'.$path;
                if($this->separate == "\\"){
                    $fullPath = str_replace('/',$this->separate,$fullPath);
                }
                if(file_exists($fullPath)){
                    unlink($fullPath);
                }
                $collection->delete();
            }
        }catch (Exception $e){

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