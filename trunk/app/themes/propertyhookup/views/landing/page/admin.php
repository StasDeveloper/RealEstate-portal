<?php
/* @var $this PageController */
/* @var $model LandingPage */

$session = Yii::app()->session;
$uri_page = '@'.Yii::app()->request->url; 
$recent_pages = 'Manage Landing Pages'.$uri_page;
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
                    Manage Landing Pages
                </h1>
            </div>
        </div>

<?php // echo BsHtml::pageHeader('Manage','Landing Pages') ?>
<div class="panel panel-default">
    <div class="panel-body">
<div class="pull-right" style="padding-bottom: 10px;">
<?php  echo BsHtml::buttonGroup(array(
	array('type'=>BsHtml::BUTTON_TYPE_LINK,'label'=>'Create Landing Page', 'url'=>array('create'), 'color'=>BsHtml::BUTTON_COLOR_PRIMARY),
    )); ?>
</div>
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'landing-page-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
                        'type' => BsHtml::GRID_TYPE_STRIPED,
			'columns'=>array(
		array(
        		'name'=>'id',
                        'filter'=>false,
		),
		array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
		),
		array(
			'name'=>'status',
			'value'=>'Lookup::item("LandingPageStatus",$data->status)',
			'filter'=>Lookup::items('LandingPageStatus'),
		),
		array(
			'name'=>'search_id',
			'value'=>'$data->search->name',
			'filter'=>false,
		),
		array(
			'name'=>'post_top_id',
			'value'=>'$data->postTop->title',
			'filter'=>false,
		),
		array(
			'name'=>'post_bottom_id',
			'value'=>'$data->postBottom->title',
			'filter'=>false,
		),
		/*
		'created_at',
		'updated_at',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
                                        'template'=>'{view} {update} {delete}',
                                        'buttons'=>array(
                                            'view'=>array(
                                                'url'=> '$data->url'
                                            )
                                        )
				),
			),
        )); ?>
    </div>
</div>

    </div>
</div>



