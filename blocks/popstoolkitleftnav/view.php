<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$currentPage = Page::getCurrentPage(); 
// ref: http://documentation.concrete5.org/api/class-Concrete.Core.Page.Page.html

$pathParts = explode("/",$currentPage->getCollectionPath());
$currentPageDepth = count($pathParts);
/*
if currentPageDepth == 3 - we are at the module's landing page 
if currentPageDepth >= 4 - we are inside a module (on a training slide).
*/
$doOutput = true;
if ($currentPageDepth == 2)
{
	$trainingModuleRootPage = $currentPage;	
}
else if ($currentPageDepth == 3)
{
	$trainingModuleRootPage = $currentPage;	
}
else if ($currentPageDepth >= 4)
{
	$arr = array($pathParts[0], $pathParts[1], $pathParts[2]);
	$moduleRootPath = join("/", $arr);	
	$trainingModuleRootPage = Page::getByPath($moduleRootPath);
}
else
{
	$doOutput = false;
}

if ($doOutput)
{

$includeThisPage = true;
$moduleSubPagesAndCurrent = array();
$moduleSubPagesAndCurrent = $trainingModuleRootPage->populateRecursivePages($moduleSubPagesAndCurrent, array('cID' => $trainingModuleRootPage->getCollectionID()), $trainingModuleRootPage->getCollectionParentID(), 0, $includeThisPage);

?>
<?php if ($currentPage->isEditMode())
{ /*
	?>
	<div>This navigation for the POPsToolkit can not be edited.</div>
<?php	
*/}
?>
<div class="popstoolkit-nav">
<ul class="nav">
<?php

foreach ($moduleSubPagesAndCurrent as $p) {
	$page = Page::getById($p['cID']);
	
	$class = '';
	if ($page->getCollectionPath() == $currentPage->getCollectionPath() )
	{
		$class= ' class="nav-selected nav-path-selected"';
	}
	
	echo('<li'.$class.'><a href="'.\URL::to($page).'">'.$page->getCollectionName().'</a></li>');
}

?>
</ul>
<?php 
} // if $doOutput
/*
Module title: <?php echo $trainingModuleRootPage->getCollectionName(); ?>  <br>
Current Page depth: <?php echo $currentPageDepth; ?>  <br>

Current Page Url: <?php echo \URL::to($currentPage); ?> <br>


	// print_r(get_class_methods($currentPage)); 
	// print_r($moduleSubPagesAndCurrent);
	*/
?>

</div>
<div class="popstoolkit-presentationmode-buttoncontainer">
	<a class="popstoolkit-presentationmode-button btn btn-default" href="#">Presentation Mode</a>
</div>
