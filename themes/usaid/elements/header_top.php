<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage() ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath()?>/css/bootstrap-modified.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath()?>/css/bootstrap-modified.css">
    <?php echo $html->css($view->getStylesheet('main.less')) ?>
    <?php
    View::element('header_required', [
        'pageTitle' => isset($pageTitle) ? $pageTitle : '',
        'pageDescription' => isset($pageDescription) ? $pageDescription : '',
        'pageMetaKeywords' => isset($pageMetaKeywords) ? $pageMetaKeywords : ''
    ]);
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style');
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            );
            document.querySelector('head').appendChild(msViewportStyle);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.5.0/intro.min.js"></script>
    <script src="/packages/usaid/themes/usaid/presentation-mode.js"></script>
    <script src="/packages/usaid/themes/usaid/FileSaver.js"></script>
    <script src="/packages/usaid/themes/usaid/Blob.js"></script>
    <script src="/packages/usaid/themes/usaid/html-docx.js"></script>
    <script src="/packages/usaid/themes/usaid/jquery.panelslider.js"></script>
    <script src="/packages/usaid/themes/usaid/usaid.js"></script>
	
    <style>
      #word {
        width: 30px; 
        height: 30px; 
        float: right; 
        cursor: pointer;
        margin-top: 50px;
        display: none;
      }
      main {
        transition: transform .2s;
      }
      
      /* Slide page 200px to the right when panel is opened */
      main.ps-active {
        transform: translateX(-800px);
      }
      
      /* Position panel */
      #panel {
        position: absolute;
        top: 0;
        right: -1000px;
        width: 800px;
        height: 100%;  /* remember to set 100% height for all its parents too, including html and body */
        background-color: #fff;
        transform: translateX(-200px);
        z-index: 999;
        display: none;
      }
      .pullout {
      display: table;
      position: absolute;
      right: 0px;
      top: 0px;
      width: 30px;
      height: 100%;

      }
      .pullout-tab {
        display: table-cell;
        vertical-align: middle;
        background: #336799;
        width: 30px;
        height: 200px;
      }
      .draft {
      position: absolute;
      left: 40%;
      font-size: 20px;
      z-index: 999;
      color: red;
      font-weight: bold;
      }
      
      div.ccm-block-page-list-page-entry-thumbnail img {
        height: 250px;
        width: 330px;
      }
    </style>
</head>
<body>
<div class="<?php echo $c->getPageWrapperClass()?>">
