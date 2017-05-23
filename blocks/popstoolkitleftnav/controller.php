<?php

namespace Concrete\Package\Usaid\Block\PopstoolkitLeftnav;

use Concrete\Core\Block\BlockController;
use Core;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController
{

    protected $btInterfaceWidth = "350";
    protected $btInterfaceHeight = "240";
    protected $btDefaultSet = 'basic';

    public function getBlockTypeName()
    {
        return t('POPs Toolkit Left Navigation');
    }


    public function getBlockTypeDescription()
    {
        return t('The standard left-navigation to use on the POPsToolkit.');
    }


}
