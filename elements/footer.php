<?php defined('C5_EXECUTE') or die("Access Denied.");

$footerSiteTitle = new GlobalArea('Footer Site Title');
$footerSiteTitleBlocks = $footerSiteTitle->getTotalBlocksInArea();

$footerSocial = new GlobalArea('Footer Social');
$footerSocialBlocks = $footerSocial->getTotalBlocksInArea();

$displayFirstSection = $footerSiteTitleBlocks > 0 || $footerSocialBlocks > 0 || $c->isEditMode();
?>

<footer>
  <div class="row">
    <div class="col-md-12 footerbar">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 footerlinks">
      <div class="container">
        <div class="row">
          <?php
          $a = new GlobalArea('Footer Navigation');
          $a->display();
          ?>
          
          <div class="col-md-4">
            <div class="footermeta">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php $this->inc('elements/footer_bottom.php');?>
