<?php defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header_top.php');

$as = new GlobalArea('Header Search');
$blocks = $as->getTotalBlocksInArea();
$displayThirdColumn = $blocks > 0 || $c->isEditMode();
?>

<header class="container">
  <div class="row">
    <div class="col-xs-6">
      <a href="/" class="">
        <img src="<?php echo $this->getThemePath(); ?>/images/logo.png" width="200px" style="margin-bottom: 15px;">
      </a>
    </div>
    <div class="col-xs-6 text-right usaid-logo">
      <a href="https://www.usaid.gov">
        <img src="https://www.usaid.gov/sites/all/themes/usaid/logo.png" alt="U.S. Agency for International Development">
      </a>
    </div>
  </div>
    <div class="row">
      <?php
      $a = new GlobalArea('Header Navigation');
      $a->display();
      ?>
    </div>
</header>
