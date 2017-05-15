<?php defined('C5_EXECUTE') or die("Access Denied.");

$footerSiteTitle = new GlobalArea('Footer Site Title');
$footerSiteTitleBlocks = $footerSiteTitle->getTotalBlocksInArea();

$footerSocial = new GlobalArea('Footer Social');
$footerSocialBlocks = $footerSocial->getTotalBlocksInArea();

$displayFirstSection = $footerSiteTitleBlocks > 0 || $footerSocialBlocks > 0 || $c->isEditMode();
?>


<footer id="footer-theme">
  
  <div class=" footerbar">
    <div class="container">
      
        <?php
        $a = new GlobalArea('Footer Navigation');
        $a->display();
        ?>
      
    </div>
  </div>
  
  
    <div class="col-md-12 footerlinks">
      <div class="container">
        

        
      </div>
    
	</div>
</footer>


<?php $this->inc('elements/footer_bottom.php');?>
