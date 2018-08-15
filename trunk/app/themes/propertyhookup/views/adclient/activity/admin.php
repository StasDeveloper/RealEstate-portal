<?php
/* @var $this AdClientController */
/* @var $model AdClientActivity */

$session = Yii::app()->session;
$uri_page = '@'.Yii::app()->request->url; 
$recent_pages = 'Manage Ad Client Activities'.$uri_page;
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
                    Manage Ad Client Activities
                </h1>
            </div>
        </div>
<div class="panel panel-default">
    <div class="panel-body">

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'ad-client-activity-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
                            'id',
                            array(
//                                    'name'=>'client_id',
                                    'header'=>'Company Name',
                                    'type'=>'raw',
                                    'value'=>'isset($data->client->company_name)?$data->client->company_name:""'
                            ),
                            array(
                                    'name'=>'status_activity',
                                    'value'=>'Lookup::item("AdClientActivityStatus",$data->status_activity)',
                                    'filter'=>Lookup::items('AdClientActivityStatus'),
//                                    'filter'=>false,
                            ),
                            'user_first_name',
                            'user_last_name',
                            'user_email',
                            'user_id',

                                    array(
                                            'class'=>'bootstrap.widgets.BsButtonColumn',
                                            'template'=>'{view} {email} {delete}', // {update}
                                            'buttons'=> array(
                                                'email'=>array(
                                                    'label'=>'Send an email to the advertiser',
                                                    'icon'=>'glyphicon-send',
                                                    'url'=>'Yii::app()->createUrl("adclient/activity/email", array("id"=>$data->id))',
                                                ),
                                            ),
                                    ),
                            ),
        )); ?>
    </div>
</div>
    </div>
</div>
<?php
$cs->registerScript(
        "changePasswordScript", "
                 
        var hasFlash = '" . $success_flag . "';
        if(hasFlash !== ''){
            $('.success1').animate({opacity:'hide'}, 2500);
            setTimeout(function(){
                $('.success1').addClass('hideblock');
            },2500);
            
        }
        
        ", CClientScript::POS_END);