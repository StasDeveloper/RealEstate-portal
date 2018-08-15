<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Irradii</h4>

        </div>
        <div class="modal-body">
            <div class="row padding-10">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <span class="modal-title pull-right">
                        <span class="">Need an account?</span>
                            <button type="button" class="btn btn-danger" id="modal-sign-up-button" data-dismiss="modal"
                                     data-toggle="modal" href="/user/registration" data-target="#modal_signup" >
                                Sign up
                            </button>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="well no-padding">
                    <div class="form">

                        
                        <?php
                        $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                            'id' => 'login-form',
                            // Please note: When you enable ajax validation, make sure the corresponding
                            // controller action is handling ajax validation correctly.
                            // There is a call to performAjaxValidation() commented in generated controller code.
                            // See class documentation of CActiveForm for details on this.
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('class' => 'smart-form client-form'),
                        ));
                        ?>
                        <header>
                            Sign In
                        </header>
                        <?php // echo $form->errorSummary($model); ?>
                         <fieldset>

                            <section>
                                <label class="label">E-mail</label>
                                <label class="input<?php echo $form->error($model,'username') ? ' state-error' : '';?>"> <i class="icon-append fa fa-user"></i>
<!--                                    <input type="email" name="email">-->
                                    <?php echo $form->textField($model, 'username', array('maxlength' => 130, "onfocus"=>"$('#login-error-div').hide();")); ?>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b>
                                <?php echo $form->error($model,'username'); ?>
                                </label>
                               
                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input<?php echo $form->error($model,'password') ? ' state-error' : '';?>"> <i class="icon-append fa fa-lock"></i>
<!--                                    <input type="password" name="password">-->
                                    <?php echo $form->passwordField($model, 'password', array('maxlength' => 32, "onfocus"=>"$('#login-error-div').hide();")); ?>
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> 
                                <?php echo $form->error($model,'password'); ?>
                                <div id="login-error-div" class="errorMessage help-inline" style="display: none;"></div>
                                </label>
                                <div class="note">
                                    <?php echo BsHtml::link('Forgot password?', Yii::app()->createUrl('/user/recovery'))?>
<!--                                    <a href="javascript:void(0)">Forgot password?</a>-->
                                </div>
                            </section>

                            <section>
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" checked="">
                                    <i></i>Stay signed in</label>
                            </section>
                        </fieldset>
                        <footer>
                            <?php // echo BsHtml::submitButton('Sign in', array('class'=>"btn btn-primary"/*'color' => BsHtml::BUTTON_COLOR_PRIMARY*/)); ?>
                            <?php
                            echo BsHtml::ajaxSubmitButton(
                                    'Sign In', array('/user/login'), array(
                                'beforeSend' => 'function(){ 
                                             $("#login-button").attr("disabled",true);
                                        }',
                                'complete' => 'function(){ 
//                                             $("#login-form").each(function(){ this.reset();});
                                             $("#login-button").attr("disabled",false);
                                        }',
                                'success' => 'function(data){  
//                                             var obj = jQuery.parseJSON(data); 
                                             var obj = data; 
                                            // View login errors!
                                            // alert(data);
                                             if(obj.login == "success"){
//                                                $("#login-form").html("<h4>Login Successful! Please Wait...</h4>");
//                                                parent.location.href = "/";
//                                                $("#modal_login").modal("hide");
                                                if( typeof clickAddSearchButton === "function") {
                                                    clickAddSearchButton();
                                                } else {
                                                    parent.location.reload();
                                                }
                                             } else {
                                                $("#login-error-div").show();
                                                $("#login-error-div").html("Login failed! Try again.");$("#login-error-div").append("");
                                             }
 
                                        }'
                                    ), array("id" => "login-button", "class" => "btn btn-primary")
                            );
                            ?>
                        </footer>

                        <?php $this->endWidget(); ?>

                    </div>
                </div>

                <h5 class="text-center"> - Or sign in using -</h5>

                <?php $this->widget('ext.hoauthwidgets.HOAuth'); ?>
                    
            </div>
        </div>
<?php /*/ ?>        
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
<?php /*/ ?>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<?php
