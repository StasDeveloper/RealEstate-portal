<?php
$cs = Yii::app()->clientScript;             //connection themes
$themePath = Yii::app()->theme->baseUrl;    //connection themes
$this->layout = '//layouts/irradii';        //connection themes
?>

<!--aside-->
<?php
if (!Yii::app()->user->isGuest) {
    echo $this->renderPartial('//layouts/aside', array('profile' => $profile));
}
?>

<!--  MAIN  -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon" class="<?php echo Yii::app()->user->isGuest ? 'ribbon-guest-variant' : ''; ?>">

        <span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all of your personalized widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $this->createUrl('/user/profile');?>">Home</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('/user/profile');?>">User Profile</a>
            </li>
            <li>
                Membership
            </li>
        </ol>

    </div>
    <!-- END RIBBON -->




<div id="content" >
    <?php
    if (isset($searchMode)) { ?>
        <div class="" id="searchFormView">
            <?php echo $this->renderPartial('_membershipSearchFormView', array('previewsSearchParams'=>$previewsSearchParams, 'result'=>$result)); ?>
        </div>
        <?php
        if(isset($members)){ ?>
        <div class="" id="foundMembersView">
            <?php echo $this->renderPartial('_foundMembersView', array('members' => $members)); ?>
        </div>
            <?php
        }
    }
    else{ ?>
        <div class="well" style="background: #dff0d8; border: 1px solid #B3E0A0;">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 style="margin: 0" class="page-title txt-color-blueDark">
                        <i class="fa fa-smile-o"></i>
                        Membership
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php if(isset($_GET['status']) && $_GET['status'] == 'success'){ ?>
                    <p><i class="fa fa-check txt-color-green"></i> Your request was successfully accepted. Please wait a moment while Paypal processes your data, this could take a few minutes.</p>
                    <p><i class="fa fa-check txt-color-green"></i> Your membership status will be active in a few moments. You may check by visiting
                        <a class="btn btn-default" href="<?php echo Yii::app()->createUrl('user/profile'); ?>"><i class="fa fa-user"></i> Profile Page</a></p>
                <?php } ?>
                <?php if(isset($status) && $status == 'canceled'){ ?>
                    <p><i class="fa fa-check txt-color-green"></i> Your request for unsubscribe membership was successfully accepted. Please wait a bit, while PayPal is proceeding the data.</p>
                    <p><i class="fa fa-check txt-color-green"></i> Your membership status will be inactive in a few moments. You may check it by visiting
                        <a class="btn btn-default" href="<?php echo Yii::app()->createUrl('user/profile'); ?>"><i class="fa fa-user"></i> Profile Page</a></p>
                <?php } ?>
                <?php if(isset($status) && $status == 'error'){ ?>
                    <p><i class="fa fa-cancel"></i> Looks like a error occured. </p>
                    <p><i class="fa fa-cancel"></i> Please contact to admin.
                        <a class="btn btn-default" href="<?php echo Yii::app()->createUrl('user/profile'); ?>"><i class="fa fa-user"></i> Profile Page</a></p>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</div>


<script>
    var modalContent = '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 style="color: #446B48;" class="modal-title">Successfully Saved</h4></div><div class="modal-body"><p>Changes have been successfully saved</p></div><div style="margin-top: 0" class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">OK</button></div></div></div>';

    function navigateToPage(pageNumber){
        var id = $("input[name='id']")[0].value;
        var name = $("input[name='name']")[0].value;
        var membershipType = $("select[name='membershipType']")[0].value;
        var expireDateFrom = $("input[name='expireDateFrom']")[0].value;
        var expireDateTo = $("input[name='expireDateTo']")[0].value;
        var limit = $("select[name='limit']")[0].value;
        var params = new Array('page='+pageNumber, 'id='+id, 'name='+name, 'membershipType='+membershipType, 'expireDateFrom='+expireDateFrom, 'expireDateTo='+expireDateTo, 'limit='+limit);
        params = params.join('&');
        var url = "<?php echo $this->createUrl('PageNavigate')?>";
        $.ajax({
            url: url,
            type: "POST",
            data: {ajaxData: params},
            success: function(resp){
                console.log(resp);
                $('#searchFormView').html(resp.result.renderedSearchForm);
                $('#foundMembersView').html(resp.result.renderedMembersTable);
                activateDatePicker();
            },
            error: function(xhr,tStatus,e){
                if(!xhr){
                    alert(" We have an error ");
                    alert(tStatus+"   "+e.message);
                }else{
                    alert("else: "+e.message);
                }
            }
        });
    }

    function saveChanges(str){
        var url = "<?php echo $this->createUrl('SaveUserChanges')?>";
        var member_id = $('input.usr_'+str).attr('user_id');
        var profile_id = str;
        var membershipType = $('select.usr_'+str)[0].value;
        var membership_expire_date = $('input.usr_'+str)[0].value;
        var params = new Array('member_id='+member_id, 'profile_id='+profile_id, 'membershipType='+membershipType, 'membership_expire_date='+membership_expire_date);
        params = params.join('&');
        console.log(params);
        $.ajax({
            url: url,
            type: "POST",
            data: {ajaxData: params},
            success: function(resp){
                $('#myModalTerms').html(modalContent);
                $('#myModalTerms').modal('show');
            },
            error: function(xhr,tStatus,e){
                if(!xhr){
                    alert(" We have an error ");
                    alert(tStatus+"   "+e.message);
                }else{
                    alert("else: "+e.message);
                }
            }
        });
    }

    var activateDatePicker = function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onSelect: function (selectedDate) {
                $('#finishdate').datepicker('option', 'minDate', selectedDate);
            }
        });
    };
    activateDatePicker();
</script>


















