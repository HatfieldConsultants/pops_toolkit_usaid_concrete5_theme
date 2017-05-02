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
    <script src="/packages/usaid/themes/usaid/presentation-mode.js"></script>
	<script src="/packages/usaid/themes/usaid/FileSaver.js"></script>
    <script src="/packages/usaid/themes/usaid/Blob.js"></script>
    <script src="/packages/usaid/themes/usaid/html-docx.js"></script>
    <script>
      $(function() {
        $('#word').detach().insertBefore('.page-title').fadeIn();
        $('#word').click(function() {
          var converted = htmlDocx.asBlob($('main').html())
          saveAs(converted, 'test.docx');
        });
      });
    </script>
    <style>
      #word {
        width: 30px; 
        height: 30px; 
        float: right; 
        cursor: pointer;
        margin-top: 50px;
        display: none;
      }
    </style>
</head>
<body>
<div class="<?php echo $c->getPageWrapperClass()?>">
