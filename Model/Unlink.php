<?php
namespace Custom\ImageOptimization\Model;

class Unlink extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_file_gallery';

    protected $_cacheTag = 'custom_file_gallery';

    protected $_eventPrefix = 'custom_file_gallery';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        //\Magento\Framework\Model\Resource\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, null, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Custom\ImageOptimization\Model\ResourceModel\Unlink');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}