<?php /* @var Controller $this */ ?>
<?php $this->beginContent('//layouts/main'); ?>


    <div class="col-xs-12">
        <div id="content">
            <?= $content; ?>
        </div>
        <!-- content -->
    </div>
    <div class="col-xs-2 text-left last" id="sidebarp">
        <div id="sidebar">
            <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'operations'),
            ));
            ?>
        </div>
        <!-- sidebar -->
    </div>
<?php $this->endContent(); ?>