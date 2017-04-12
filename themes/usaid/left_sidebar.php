<?php
defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header.php');
?>

<main>
    <?php
    $a = new Area('Page Header');
    $a->enableGridContainer();
    $a->display($c);
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="hidden-sm-down col-lg-2 col-md-4 col-sidebar">
                <?php
                $a = new Area('Sidebar');
                $a->display($c);
                ?>
            </div>
            <div class="col-sm-12 col-lg-10 col-md-8 col-content">
                <?php
                $a = new Area('Main');
                $a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
        </div>
    </div>

    <?php
    $a = new Area('Page Footer');
    $a->enableGridContainer();
    $a->display($c);
    ?>
</main>

<?php
$this->inc('elements/footer.php');
