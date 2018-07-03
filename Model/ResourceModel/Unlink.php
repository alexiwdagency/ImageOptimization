<?php
namespace Custom\ImageOptimization\Model\ResourceModel;


class Unlink extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('custom_file_gallery', 'id');
    }

}