<?php

namespace Custom\ImageOptimization\Helper;
use \Magento\Framework\App\ObjectManager;
use \Magento\Framework\App\Filesystem\DirectoryList;

class Unlink extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $files = array();
    public $gallery = 'catalog_product_entity_media_gallery';

    public function getFiles()
    {
        $objectManager = $this->getInstance();
        $filesystem = $objectManager->get('Magento\Framework\Filesystem');
        $directory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $imageDir = $directory->getAbsolutePath() . DIRECTORY_SEPARATOR . 'catalog' . DIRECTORY_SEPARATOR . 'product';

        $directoryIterator = new \RecursiveDirectoryIterator($imageDir);

        $i = 0;

        foreach (new \RecursiveIteratorIterator($directoryIterator) as $file) {
            if (strpos($file, "/cache") !== false || is_dir($file) || strpos($file, "\cache") !== false) {
                continue;
            }
            $filePath = str_replace('\\','/',str_replace($imageDir, "", $file));
            $this->files[$i] = $filePath;
            $i++;
        }

        return $this->files;
    }

    public function updateUnlinkModel(){

        $files = $this->getFiles();

        foreach ($files as $file){
            if($this->getExists($file) == false){
                $this->save($file);
            }
        }

    }

    public function getInstance(){
        return ObjectManager::getInstance();
    }

    public function getExists($filePath){

        $resource = $this->getInstance()->get('Magento\Framework\App\ResourceConnection');
        $gallery = $resource->getConnection()->getTableName($this->gallery);
        $coreRead = $resource->getConnection('core_read');
        $value = $coreRead->fetchOne('SELECT * FROM ' . $gallery . ' WHERE value = ?', array($filePath));
        return $value;
    }

    public function save($filePath){
        $collection = $this->getInstance()->get('\Custom\ImageOptimization\Model\Unlink');
        $collection->setPath($filePath);
        $collection->save();
    }
}
?>