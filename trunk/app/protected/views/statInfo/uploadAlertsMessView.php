<?php
/* @var $this StatInfoController */
/* @var $model AlertsMessages */
/* @var $form CActiveForm */

$themePath = Yii::app()->theme->baseUrl;
$this->layout = '//layouts/irradii';

?>

<!--aside-->
<?php
if (!Yii::app()->user->isGuest) {
    echo $this->renderPartial('/layouts/aside', array('profile' => $profile));
}
?>
<div id="main" role="main" class="<?php echo Yii::app()->user->isGuest ? 'guest-variant' : ''; ?>">

    <!-- RIBBON -->
    <div id="ribbon" class="<?php echo Yii::app()->user->isGuest ? 'ribbon-guest-variant' : ''; ?>">

        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all of your personalized widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Import Email Alert Messages
            </li>

        </ol>

    </div>
    <!-- END RIBBON -->

    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h1 class="page-title txt-color-blueDark">
                    Import Email Alerts Message File
                </h1>
            </div>
        </div>


    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div class="well" style="background: #dff0d8; border: 1px solid #B3E0A0;">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if(Yii::app()->user->hasFlash('error')): ?>
        <div class="well" style="background: #F3C9D3; border: 1px solid #A90329;">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="smart-form">
                <?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>

                    <section>
                        <label class="label">Browse file</label>
                        <div class="input input-file">
                            <span class="button">
                                <?php echo CHtml::activeFileField($model, 'document',array(
                                    'id' => "file",
                                    'onchange' => 'getElementById("avatar_picture_text_input").value = this.value'
                                )); ?> Browse File
                            </span>

                            <input type="text" id="avatar_picture_text_input" placeholder="Upload text file in .csv format only" readonly="">
                        </div>
                    </section>

                    <?php echo CHtml::submitButton('Upload', array('class'=>'btn btn-primary btn-lg')); ?>
                <?php echo CHtml::endForm(); ?>

            </div>
        </div>
    </div>







</div>