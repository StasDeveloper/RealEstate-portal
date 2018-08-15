<?php echo BsHtml::pageHeader('Stat','Infos') ?>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-3">
            <h3>Loaded Properties <?php echo !empty($totalProperty)?$totalProperty:'-'; ?></h3>
        </div>
        <div class="col-md-3">
            <h3>Need to Recalculate <?php echo !empty($needRecalculate)?$needRecalculate:'-'; ?></h3>
        </div>
        <div class="col-md-2">
            <h3>Loading Photos <?php echo !empty($totalPhoto)?$totalPhoto:'-'; ?></h3>
        </div>
        <div class="col-md-2">
            <h3>Detecting Coords <?php echo !empty($totalCoord)?$totalCoord:'-'; ?></h3>
        </div>
        <div class="col-md-2">
            <h3>Estimating Price <?php echo !empty($totalPrice)?$totalPrice:'-'; ?></h3>
        </div>
    </div>
</div>
</div>
<h2>Loaded Properties</h2>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid',
                        'dataProvider'=>$modelProperty,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                            'id',
                            'property_updated_date' ,  'property_expire_date' ,
                            'count_by',
			),
        )); ?>
        </div>
        <div class="col-md-6">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid',
                        'dataProvider'=>$modelProperty1,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                            'id',
                            'property_uploaded_date' ,  'property_expire_date' ,
                            'count_by',
			),
        )); ?>
        </div>
<!--        <div class="col-md-2">
            <h3>Total <?php // echo $totalPhoto; ?></h3>
        </div>-->
    </div>
</div>
</div>

<h2>Recalculated Prices</h2>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-price-grid-1',
                        'dataProvider'=>$modelPriceDate,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                            'id',
                            'estimated_price_recalc_at' ,
                            'count_by',
			),
        )); ?>
        </div>
    </div>
</div>
</div>

<h2>Loading Photos</h2>
<div class="row">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'property-info-grid1',
                        'dataProvider'=>$modelPhoto,
//                        'filter'=>$modelPhoto,
                        'columns'=>array(
                            'id',
                            'mls_sysid',
                            'process',
                            'created_at',
                            'process_at',
                            'count_by',
			),
        )); ?>
        </div>
<!--        <div class="col-md-2">
            <h3>Total <?php echo $totalPhoto; ?></h3>
        </div>-->
    </div>
</div>
</div>
<br/>
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
			'id'=>'property-info-grid3',
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

