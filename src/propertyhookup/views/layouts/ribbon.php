<!-- RIBBON -->
<div id="ribbon" class="<?php echo Yii::app()->user->isGuest ? 'ribbon-guest-variant' : ''; ?>">

    <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all of your personalized widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo Yii::app()->homeUrl?>">Home</a>
        </li>
        <?php
            if(isset($breadcrumbs)){
                foreach ($breadcrumbs as $item){
                    ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl($item['action'], $params = array())?>"><?php echo $item['title'];?></a>
                    </li>
        <?php
                }
            }

        ?>
    </ol>
    <?php /*/ ?>
        <span class="ribbon-button-alignment pull-right">
            <a href="javascript:void(0);" class="btn btn-ribbon" id="save"> 
                <span class="btn-label"><i class="glyphicon glyphicon-check"></i></span>Save </a>
            <a href="javascript:void(0);" class="btn btn-ribbon" id="share"> 
                <span class="btn-label"><i class="glyphicon glyphicon-share"></i></span>Share </a>
            <a href="javascript:void(0);" class="btn btn-ribbon hidden-xs" id="print"> 
                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Print</a>


            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i>TRACK</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i>SAVE</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">PRINT</span></span>
         
         </span> -->
<?php /*/ ?>
</div>
<!-- END RIBBON -->