<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>

<?php if ($c->isEditMode() && $controller->isBlockEmpty()) {
    ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.')?></div>
<?php
} else {
    ?>

<div class="ccm-block-page-list-wrapper">

    <?php if (isset($pageListTitle) && $pageListTitle): ?>
        <div class="ccm-block-page-list-header">
            <h5><?php echo h($pageListTitle)?></h5>
        </div>
    <?php endif;
    ?>

    <?php if (isset($rssUrl) && $rssUrl): ?>
        <a href="<?php echo $rssUrl ?>" target="_blank" class="ccm-block-page-list-rss-feed"><i class="fa fa-rss"></i></a>
    <?php endif;
    ?>

    <div class="ccm-block-page-list-pages">

    <?php    
	$pageIndex = 0;
	$rowStarted = false;
    foreach ($pages as $page):

        // Prepare data for each page being listed...

    $title = $th->entities($page->getCollectionName());
    $url = ($page->getCollectionPointerExternalLink() != '') ? $page->getCollectionPointerExternalLink() : $nh->getLinkToCollection($page);
    $target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
    $target = empty($target) ? '_self' : $target;

    
    $thumbnail = $page->getAttribute('thumbnail');
	if (!is_object($thumbnail)){
		$tag = '<img src="https://placehold.it/1000x500" class="img-responsive">';
	}
	else {
		$img = Core::make('html/image', array($thumbnail));
		$tag = $img->getTag();
		$tag->addClass('img-responsive');
		
	}
	
	if ($pageIndex % 3 == 0)
	{
		if ($rowStarted)
		{
			echo '</div><!-- row -->';
		}
		echo '<div class="row">';
		$rowStarted = true;
	}
	?>
    <div class="col-md-4">    
		<a href="<?php echo $url ?>" target="<?php echo $target ?>" class="trainingmodulepanel">
		<div class="panel panel-default panel-trainingmodule">
		  <div class="panel-heading">
			<h3 class="panel-title">
				<?php echo $title ?>
			</h3>
		  </div>
		  <div class="panel-body">
				
					<div class="ccm-block-page-list-page-entry-thumbnail">
						<?php						
						echo $tag;
						?>
					</div>
				
		  </div>
		</div>
		</a>
	</div>
		
        



      
	<?php $pageIndex++; ?>
	<?php endforeach;
    
	if ($rowStarted)
	{
		echo '</div><!-- row -->';
	}
	?>
    </div>

    <?php if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
    <?php endif;
    ?>

</div><!-- end .ccm-block-page-list -->


<?php if ($showPagination): ?>
    <?php echo $pagination;
    ?>
<?php endif;
    ?>

<?php
} ?>
