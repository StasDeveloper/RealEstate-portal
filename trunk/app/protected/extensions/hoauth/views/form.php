<?php
/**
 * @var HOAuthAction $this
 * @var HUserInfoForm $form
 */

$this->layout = '//layouts/irradii';
$this->body_ID = 'id="login"';

?>
<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <div class="well no-padding">
                    <div class="form">
<?php
        echo $form->form;
?>
                    </div>
                </div>
            </div>
        </div>

    </div>