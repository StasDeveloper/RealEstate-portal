<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$session = Yii::app()->session;
$uri_page = '@'.Yii::app()->request->url; 
$recent_pages = 'Landing Pages'.$uri_page;
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

    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    Landing Pages
                </h1>
            </div>
        </div>


<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

    </div>
</div>