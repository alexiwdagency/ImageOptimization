<?php

namespace Custom\ImageOptimization\Ui\Component\Listing\Column;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;

class Images extends Column
{
    public function __construct(ContextInterface $context, \Custom\ImageOptimization\Helper\Unlink $helper, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->helper = $helper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $size = $this->helper->getSize($item['id']);
                $item[$this->getData('name')] = $size;
            }
        }

        return $dataSource;
    }
}