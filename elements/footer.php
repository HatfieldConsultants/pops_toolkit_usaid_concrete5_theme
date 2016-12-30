<?php defined('C5_EXECUTE') or die("Access Denied.");

$footerSiteTitle = new GlobalArea('Footer Site Title');
$footerSiteTitleBlocks = $footerSiteTitle->getTotalBlocksInArea();

$footerSocial = new GlobalArea('Footer Social');
$footerSocialBlocks = $footerSocial->getTotalBlocksInArea();

$displayFirstSection = $footerSiteTitleBlocks > 0 || $footerSocialBlocks > 0 || $c->isEditMode();
?>


<footer id="footer-theme">
  <div class="col-md-12 footerbar">
    <div class="container">
      <div class="row">
        <?php
        $a = new GlobalArea('Footer Navigation');
        $a->display();
        ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 footerlinks">
      <div class="container">
        <div class="row">
          <p>
            <small>
               <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a> | <a href="#">Accessibility</a>
            </small>
          </p>
          <small>
            The information provided on this website is not official U.S. government information and does not represent the views or positions of the U.S. Agency for International Development or the U.S. Government.
          </small>
        </div>
      </div>
    </div>
  </div>
</footer>


<?php $this->inc('elements/footer_bottom.php');?>
