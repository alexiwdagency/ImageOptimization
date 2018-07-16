<?php
namespace Custom\ImageOptimization\Model\ResourceModel\Unlink;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'custom_imageoptimization_unlink_collection';
    protected $_eventObject = 'unlink_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Custom\ImageOptimization\Model\Unlink', 'Custom\ImageOptimization\Model\ResourceModel\Unlink');
    }

}