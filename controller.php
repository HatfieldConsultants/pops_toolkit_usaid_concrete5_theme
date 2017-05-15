<?php
namespace Concrete\Package\Usaid;

use Concrete\Core\Package\Package;
use Concrete\Core\Page\Theme\Theme;
use Concrete\Core\Block\BlockType\BlockType;
use \Concrete\Core\Page\Single as SinglePage;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
  protected $pkgHandle = 'usaid';
  protected $appVersionRequired = '5.7.1';
  protected $pkgVersion = '1.0.3';

  public function getPackageDescription()
  {
      return t("Adds USAID Theme.");
  }

  public function getPackageName()
  {
      return t("USAID");
  }

  public function install()
  {
      $pkg = parent::install();
      Theme::add('usaid', $pkg);
  }

  public function upgrade() {
    parent::upgrade();
    $pkg = Package::getByHandle('usaid');
    SinglePage::add('/all_pages', $pkg);
  }
}
