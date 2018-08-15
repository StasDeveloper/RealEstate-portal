<?php ?>
<div class="well well-sm">
    <div class="bs-example">
            <div class="row">
                <div class="col-xs-6 ">
                    <?php if(empty($adclient->company_logo)) : ?>
                        <img src="http://img1.irradii.com/image_absent.jpg" alt="company_logo" class="img-thumbnail">
                    <?php else: ?> 
                        <img src="<?php echo $adclient->company_logo; ?>" alt="company_logo" class="img-thumbnail">
                    <?php endif; ?>
                </div>
                <div class="col-xs-6">
                    <dt class="txt-color-blue"> <?php echo $adclient->company_name; ?> <span class="label label-default"><?php echo $adclient->adCategory->ad_category; ?></span> </dt>
                    <div class=" padding-top-10">
                    <button class="btn btn-sm btn-primary"  data-toggle="modal" href="<?php echo Yii::app()->createUrl('adclient/activity/submit', $params = array('id'=>$adclient->id))?>" data-target="#modal-user-activity-<?php echo $adclient->id; ?>" >Contact Us</button>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 ">
                    <dd><?php echo $adclient->ad_tag_line; ?></dd>
                </div>
            </div>
    </div>			
</div>
<!-- Modal -->
<div class="modal fade" id="modal-user-activity-<?php echo $adclient->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!-- /.modal -->