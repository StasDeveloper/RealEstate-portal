<?php // test
$session = Yii::app()->session;
$uri_page = '@'.Yii::app()->request->url; 
$recent_pages = 'Posts '.$uri_page;
if(!isset($session['recent_pages']) || count($session['recent_pages'])==0){
    $session['recent_pages'] = array($recent_pages);
} else {
    $sess_arr = $session['recent_pages'];
    $sess_arr[]=$recent_pages;
    $session['recent_pages'] = $sess_arr;
}
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
$this->layout = '//layouts/irradii';
$success_flag = '';
//$this->body_onload = 'onload="initialize()"';
?>

<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<!--aside-->
<?php if(!Yii::app()->user->isGuest){
    echo $this->renderPartial('//layouts/aside',array('profile'=>$profile));
}?>
<!-- END NAVIGATION -->


<!-- MAIN PANEL -->
<div id="main" role="main">
    
    <?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
        <div class="success1">
            <?php
            $success_flag = 1;
            echo Yii::app()->user->getFlash('profileMessage');
            ?>
        </div>
    <?php endif; ?>
<?php /*/ ?>    
    <!-- RIBBON -->
    <div id="ribbon">

        <div class="ribbon-button-alignment"> 
            <div id="refresh" 
                  class="btn btn-ribbon" 
                  data-title="refresh"  
                  rel="tooltip" 
                  data-placement="bottom" 
                  data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." 
                  data-html="true">
                <i class="fa fa-refresh"></i>
            </div> 
        </div>

        <!-- breadcrumb -->
        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'separator' => "&nbsp;&nbsp;/&nbsp;&nbsp;",
            ));
            ?><!-- breadcrumbs -->
        <?php endif ?>

        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->
<?php /*/ ?>
    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    Posts 
<?php if(!empty($_GET['tag'])): ?>
Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i>
<?php endif; ?>

                </h1>
            </div>
        </div>
<?php $this->widget('bootstrap.widgets.BsListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>
    </div>
</div>