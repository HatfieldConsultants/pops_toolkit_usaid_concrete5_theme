<?php defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header_top.php');

$as = new GlobalArea('Header Search');
$blocks = $as->getTotalBlocksInArea();
$displayThirdColumn = $blocks > 0 || $c->isEditMode();
?>

<header>
  <div class="container">
    <div class="row">
	<div class="col-xs-6">
      <a href="/" class="">
        <img src="<?php echo $this->getThemePath(); ?>/images/POPs Toolkit_Logo_340x50.png" width="340px" style="margin-bottom: 15px;">
      </a>
    </div>
    <div class="col-xs-6 text-right usaid-logo">
      <a href="https://www.usaid.gov">
        <img src="https://www.usaid.gov/sites/all/themes/usaid/logo.png" alt="U.S. Agency for International Development">
      </a>
    </div>
	</div>
  </div>
  <div class="navbar">
    <div class="container">
      <?php
      $a = new GlobalArea('Header Navigation');
      $a->display();
      ?>
    </div>
  </div>
</header>
