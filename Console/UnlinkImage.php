<?php
namespace Custom\ImageOptimization\Console;

use Magento\Setup\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UnlinkImage extends Command
{
    public $helper;

    public function __construct(
        \Custom\ImageOptimization\Helper\Unlink $helper
    )
    {
        parent::__construct();
        $this->helper = $helper;
    }

    protected function configure()
    {
        $this->setName('custom:product:unlink');
        $this->setDescription('Delete images unassigned for products');

        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try{
            $this->helper->updateUnlinkModel();
            echo "function was done successfully";
        }catch (Exception $e){
            echo "You have an error";
        }

    }
}