<?php
/* @var $this PropertyInfoSlugController */
/* @var $model PropertyInfoSlug */

$themePath = Yii::app()->theme->baseUrl;
$this->layout = '//layouts/irradii';

?>

<?php echo BsHtml::pageHeader('History Search','') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Property Info History Search</h3>
    </div>
    <div class="panel-body">
        <div class="search-form" style="display:none">
            <?php /*$this->renderPartial('_search',array(
                'model'=>$model,
            )); */?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
            'id'=>'property-info-history-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
//                'id',
                'property_id',
                'mls_sysid',
                array(
                    'name'=>'property_info_slug',
                    'value'=>'$data->historySlug',
                    'filter'=>CHtml::textField('PropertyInfoHistory[property_info_slug]', $model->property_info_slug, array('class'=>'form-control')),
                ),
                array(
                    'class'=>'bootstrap.widgets.BsButtonColumn',
                    'template'=>'{view}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'url'=>'Yii::app()->createUrl("statInfo/factor", array("id" => $data->property_id))',
                        ),

                    )

                ),
                array
                (
                    'class'=>'CButtonColumn',
                    'template'=>'{history}',
                    'buttons'=>array
                    (
                        'history' => array
                        (
                            'label'=>'History',
                            'url'=>'Yii::app()->createUrl("property/history", array("id" => $data->property_id, "slug" => $data->historySlug))',
//                            'url'=>'Yii::app()->createUrl("statInfo/history", array("id" => $data->property_id, "slug" => $data->getHistorySlug($data->property_id)))',
                        ),
                    ),
                ),
            ),
        )); ?>
    </div>
    <script>
        $('#property-info-history-grid .table').removeClass('items');
//        $('.pagination').addClass('hidden');
    </script>
</div>




