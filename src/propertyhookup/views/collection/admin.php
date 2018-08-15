<?php
/* @var $this CollectionController */
/* @var $model TblProfessionFieldCollection */


$this->breadcrumbs=array(
	'Tbl Profession Field Collections'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'List TblProfessionFieldCollection', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create TblProfessionFieldCollection', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbl-profession-field-collection-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Manage','Tbl Profession Field Collections') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'tbl-profession-field-collection-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'collection_id',
		'authitem_name',
		'first_name',
		'middle_name',
		'last_name',
		'office',
		/*
		'street_address',
		'address1',
		'address2',
		'state',
		'county',
		'city',
		'zipcode',
		'phone',
		'phone_office',
		'phone_fax',
		'phone_home',
		'phone_mobile',
		'website_url',
		'tagline',
		'years_of_experience',
		'years_of_experience_text',
		'area_expertise',
		'area_expertise_text',
		'about_me',
		'upload_photo',
		'office_logo',
		'upload_logo',
		'listing_type',
		'payment_type',
		'join_date',
		'join_only_date',
		'membership_expire_date',
		'membership_subscription_date',
		'audit_expire_date',
		'profile_completion_percentage',
		'rating_average',
		'agent_last_login',
		'agent_comments',
		'profile_notification',
		'website_notification',
		'listings_notification',
		'subscription',
		'timestamp',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




