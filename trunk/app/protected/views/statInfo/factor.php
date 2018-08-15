<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<?php echo BsHtml::pageHeader('Stat','Factors') ?>
<h2>Property#<?php echo $property_id ?></h2>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid1',
                        'dataProvider'=>$property,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                    'id',
                    'fundamentals_factor',
                    'conditional_factor',
                    'property_price',
                    'estimated_price',
                    'comp_stage', 'comps', 'house_square_footage_gravity', 'lot_footage_gravity',
                    'property_type',
                    'property_zipcode',
                    'compass_point',
                    'house_faces',
                    'house_views',
                    'street_name',
                    'pool',
                    'spa',
                    'stories',
                    'lot_description',
                    'building_description',
                    'carport_type',
                    'converted_garage',
                    'exterior_structure',
                    'roof',
                    'electrical_system',
                    'plumbing_system',
                    'built_desc',
                    'exterior_grounds',
                    'prop_desc',
                    'over_all_property',
                    'foreclosure',
                    'short_sale',
                    'sub_type',

                    'studio',
                    'condo_conversion',
                    'association_features_available',
                    'association_fee_1',
                    'assessment',
                    'sidlid',
                    'parking_description',
                    'fence_type',
                    'court_approval',
                    'bath_downstairs',
                    'bedroom_downstairs',
                    'great_room',
                    'bath_downstairs_description',
                    'flooring_description',
                    'furnishings_description',
                    'heating_features',
                    'possession_description',
                    'financing_considered',
                    'reporeo',
                    'litigation',
			),
            'htmlOptions'=>array(
                'style'=>'overflow-x:scroll'
            ),
        )); ?>
        </div>
    </div>
</div>
</div>
<br/>

<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid1-1',
                        'dataProvider'=>$result_query,
//                        'filter'=>$modelPhoto,
                        'columns'=> $result_query_columns,
            'htmlOptions'=>array(
                'style'=>'overflow-x:scroll'
            ),
        )); ?>
        </div>
    </div>
</div>
</div>
<br/>

<h2> Estimated Value Builder </h2>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid2',
                        'dataProvider'=>$estimatedValueTable,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                            'item::',
                    array(
                        'header'=>'Price per Unit',
                        'type'=>'raw',
                        'value'=>'"$".$data["Price_per_Unit"]',
                        'htmlOptions'=>array(
    				'class'=>'',
    				'style'=>'text-align:right',
                            )
                        ),
                            'Property_Quantity::Property Quantity',
                    array(
                        'header'=>'Total',
                        'type'=>'raw',
                        'value'=>'"$".$data["Total"]',
                        'htmlOptions'=>array(
    				'class'=>'',
    				'style'=>'text-align:right',
                            )
                        ),
                            'Weight',
                    array(
                        'header'=>'Weighted Value',
                        'type'=>'raw',
                        'value'=>'"$".$data["Weighted_Value"]',
                        'htmlOptions'=>array(
    				'class'=>'',
    				'style'=>'text-align:right',
                            )
                        ),
			),
                        'type' => BsHtml::GRID_TYPE_BORDERED,
        )); ?>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-4">
            <h2 class=""> Stage <?php echo $estimatedValues['comp_stage'] ?></h2>
        </div>
        <div class="col-md-4">
            <h2 class=""> Comps <?php echo $estimatedValues['comps'] ?></h2>
        </div>
        <div class="col-md-4">
<h2 class="pull-right">Total True Market Value <?php echo (!empty($estimatedPrice)? '$'.number_format($estimatedPrice,2):'-') ?></h2>
        </div>
    </div>
</div>
</div>


<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-3">Fundamental Factor 
<h2><?php echo !empty($newFactors['fundamentals_factor'])?$newFactors['fundamentals_factor']:0.00 ?></h2>
        </div>
        <div class="col-md-3">Conditional Factor 
<h2><?php echo !empty($newFactors['conditional_factor'])?$newFactors['conditional_factor']:0.00 ?></h2>
        </div>
        
        <div class="col-md-3">Price 
<h2><?php echo '$'.number_format($property_price,2) ?></h2>
        </div>
        <div class="col-md-3">Estimated Price 
            <span id="save-to-property-info" class="btn btn-info btn-sm pull-right" title="Save to PropertyInfo"><span class="glyphicon glyphicon-save"></span> Save </span>
<h2><?php echo !empty($estimatedValues['estimated_price'])?'$'.number_format($estimatedValues['estimated_price'],2):'-' ?></h2>
        </div>
    </div>
</div>
</div>
<br/>
<h2>Factors rows</h2>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid3',
                        'dataProvider'=>$factorsNew,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                    'id',
//                    'factor_type',
//                    'factor_value',
                    array(
                        'header'=>'factor_type',
                        'type'=>'raw',
                        'value'=>'CHtml::link(CHtml::encode($data->factor_type), "#", array("data-pk"=>$data->id,"data-name"=>"factor_type","data-value"=>$data->factor_type,"data-type"=>"select","data-source"=>"[\'fundamentals_factor\', \'conditional_factor\']", "data-url"=>Yii::app()->controller->createUrl("factorupdate", array("id" => '. $property_id .')),"class"=>"edit-cell"))',
                        'htmlOptions'=>array(
    				'class'=>'',
    				'style'=>'text-align:right',
                            )
                        ),
                    array(
                        'header'=>'factor_value',
                        'type'=>'raw',
                        'value'=>'CHtml::link(CHtml::encode($data->factor_value), "#", array("data-pk"=>$data->id,"data-name"=>"factor_value","data-url"=>Yii::app()->controller->createUrl("factorupdate", array("id" => '. $property_id .')),"class"=>"edit-cell"))',
                        'htmlOptions'=>array(
    				'class'=>'',
    				'style'=>'text-align:right',
                            )
                        ),                    
                    array(
                        'header'=>'dollar_value',
                        'value'=>'Yii::app()->controller->dollar_value[$data->id]', // '$data->conditional_factor'
                        'htmlOptions'=>array(
    				'class'=>'',
    				'style'=>'text-align:right',
                            )
                        ),
                    'property_type',
                    'property_zipcode',
                    'compass_point',
                    'house_faces',
                    'house_views',
                    'street_name',
                    'pool',
                    'spa',
                    'stories',
                    'lot_description',
                    'building_description',
                    'carport_type',
                    'converted_garage',
                    'exterior_structure',
                    'roof',
                    'electrical_system',
                    'plumbing_system',
                    'built_desc',
                    'exterior_grounds',
                    'prop_desc',
                    'over_all_property',
                    'foreclosure',
                    'short_sale',
                    'sub_type',

                    'studio',
                    'condo_conversion',
                    'association_features_available',
                    'association_fee_1',
                    'assessment',
                    'sidlid',
                    'parking_description',
                    'fence_type',
                    'court_approval',
                    'bath_downstairs',
                    'bedroom_downstairs',
                    'great_room',
                    'bath_downstairs_description',
                    'flooring_description',
                    'furnishings_description',
                    'heating_features',
                    'possession_description',
                    'financing_considered',
                    'reporeo',
                    'litigation',
			),
                'htmlOptions'=>array(
                    'style'=>'overflow-x:scroll'
                ),
            )); ?>
        </div>
    </div>
</div>
</div>
<br/>

<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid1-2',
                        'dataProvider'=>$result_query_all,
//                        'filter'=>$modelPhoto,
                        'columns'=> $result_query_all_columns,
            'htmlOptions'=>array(
                'style'=>'overflow-x:scroll'
            ),
        )); ?>
        </div>
    </div>
</div>
</div>
<br/>

<?php // echo $factorsStr ?>
<?php /*/ ?>
<div class="row">
<h2>Detecting Coords</h2>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid2',
                        'dataProvider'=>$modelCoord,
//                        'template' => '{items}',
//                        'filter'=>$model,
                        'columns'=>array(
                        'id', 'property_street', 'property_zipcode', 'property_updated_date',
                            'count_by',
			),
        )); ?>
        </div>
<!--        <div class="col-md-2">
            <h3>Total <?php echo $totalCoord; ?></h3>
        </div>-->
    </div>
</div>
</div>

<br/>
<div class="row">
<h2>Estimating Price</h2>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid4',
                        'dataProvider'=>$modelPrice,
//                        'template' => '{items}',
//                        'filter'=>$model,
                        'columns'=>array(
                            'id',
                             'property_zipcode', 'last_property_id', 'created_at',
                            'count_by',
			),
        )); ?>
        </div>
<!--        <div class="col-md-2">
            <h3>Total <?php echo $totalPrice; ?></h3>
        </div>-->
    </div>
</div>
</div>

<?php /*/ ?>
<?php 
Yii::app()->clientScript->registerScript(
        "factorEdit", "
$('#property-info-grid3 a.edit-cell').editable({
success: function(response, newValue) {
        if(response.status == 'error') return response.msg; //msg will be shown in editable form
        location.reload(true);
    }
});

$('#save-to-property-info').click(function(e){
                    $.ajax({
                        url: '" . Yii::app()->controller->createUrl("propertyupdate", array("id" => $property_id ))."',
                        type: 'POST',
                        data: { factors : ". json_encode($newFactors) . " },
                        dataType: 'json',
                        cache: false,
                        complete: function(xhr, str){
                            location.reload(true);
                        },
                        error:  function(xhr, str){
//                            console.log('error: ' + xhr.responseCode);
                        }
                    });
                    e.stopPropagation();
                    $('#save-to-property-info').addClass('disabled');
                    
});
            ", CClientScript::POS_READY);
