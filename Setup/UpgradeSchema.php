<?php

namespace Custom\ImageOptimization\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements  UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.2') < 0) {

            if (!$installer->tableExists('custom_file_gallery')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('custom_file_gallery')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'ID'
                    )

                    ->addColumn(
                        'path',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Path'
                    );
                $installer->getConnection()->createTable($table);

            }
        }

        $installer->endSetup();
    }
}
?>