<?php
/* @var $this AdClientController */
/* @var $model AdClient */

$session = Yii::app()->session;
$uri_page = '@'.Yii::app()->request->url; 
$recent_pages = 'Manage Ad Clients'.$uri_page;
if(!isset($session['recent_pages']) || count($session['recent_pages'])==0){
    $session['recent_pages'] = array($recent_pages);
} else {
    $sess_arr = $session['recent_pages'];
    $sess_arr[]=$recent_pages;
    $session['recent_pages'] = $sess_arr;
}
$cs = Yii::app()->clientScript;
$themePath = Yii::app()->theme->baseUrl;
//$this->layout = '//layouts/irradii';
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
                    Manage Ad Clients
                </h1>
            </div>
        </div>
<div class="panel panel-default">
    <div class="panel-body">

<div class="pull-right" style="padding-bottom: 10px;">
<?php  echo BsHtml::buttonGroup(array(
	array('type'=>BsHtml::BUTTON_TYPE_LINK,'label'=>'Create Ad Client', 'url'=>array('create'), 'color'=>BsHtml::BUTTON_COLOR_PRIMARY),
    )); ?>
</div>

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'ad-client-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
		array(
			'name'=>'ad_category_id',
			'value'=>'AdClientCategory::item($data->ad_category_id)',
			'filter'=>AdClientCategory::items(),
		),
		array(
			'name'=>'company_name',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->company_name), $data->id)'
		),
		array(
			'name'=>'status',
			'value'=>'Lookup::item("AdClientStatus",$data->status)',
			'filter'=>Lookup::items('AdClientStatus'),
		),
                'for_all',
		'rep_name',
		'contact_phone_number',
		'contact_email',
		/*
		'company_logo',
		'company_address',
		'company_website',
		'alt_contact_phone_number',
		'contact_email',
		'alt_contact_email',
		'ad_tag_line',
		'ad_description',
		'ad_confirmation_message',
		'message_to_advertiser',
		'updated_at',
		'created_at',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>
    </div>
</div>
