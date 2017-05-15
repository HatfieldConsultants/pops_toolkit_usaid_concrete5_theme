<?php namespace Concrete\Package\Usaid\Controller\SinglePage;

  use Concrete\Core\Page\Controller\PageController;

  class AllPages extends PageController
  {
    public function view() {
      $page = Page::getByPath('/' . $_GET['path']); 
      $includeThisPage = true;
      $moduleSubPagesAndCurrent = array();
      $moduleSubPagesAndCurrent = $page->populateRecursivePages($moduleSubPagesAndCurrent, array('cID' => $page->getCollectionID()), $page->getCollectionParentID(), 0, $includeThisPage);
      //$data = $this->getResult( $this->post( 'query' ) );
      //$json = json_encode( $data );
      header('Content-Type: application/json');
      //echo $json;
      echo "{}";
      exit;
    }
  }
?>
