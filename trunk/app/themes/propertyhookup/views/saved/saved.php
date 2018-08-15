<?php
/* @var $this SavedController */
if (!Yii::app()->user->isGuest) {
	echo $this->renderPartial('/layouts/aside', array('profile' => $profile));
}
?>
<div id="main" role="main" class="<?php echo Yii::app()->user->isGuest ? 'guest-variant' : ''; ?>">
	<?php echo $this->renderPartial('/layouts/ribbon', array('breadcrumbs' => $breadcrumbs)); ?>
	<div id="content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h1 class="page-title txt-color-blueDark">
					<i class="fa fa-lg fa-fw fa-heart"></i>
					Saved Properties
				</h1>
			</div>
		</div>
		<div class="row">
			<div class="jarviswidget" id="wid-id-saved-properties-table"
				 data-widget-editbutton="false"
				 data-widget-colorbutton="false"
				 data-widget-deletebutton="true"
				 data-widget-togglebutton="true"
			>
				<!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2> Tagging History</h2>
				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding mobile-wrapper">
						<div class="widget-body-toolbar">
							<form action="#" class="status_filter">
								<select multiple class="select2" name="status_type">
									<?php
									$excluded_statuses = array();
									$excluded_statuses_for_prop = $this->default_excluded_status_types ? $this->default_excluded_status_types : null;

									if (isset($session['excluded_statuses'])) {
										$excluded_statuses = $session['excluded_statuses'];
									}

									foreach ($this->status_types as $status_type) {
										if (in_array($status_type, $excluded_statuses_for_prop)) {
											echo '<option value="' . $status_type . '">' . $status_type . '</option>';
										} else {
											echo '<option value="' . $status_type . '" selected>' . $status_type . '</option>';
										}
									}
									?>
								</select>
							</form>
							<div style="clear:both"></div>
						</div>
						<table class="table table-striped table-hover datatable_tabletools">
							<thead>
							<tr>
								<th>Value</th>
								<th>Address</th>
								<th>Status</th>
								<th>List Price</th>
								<th>Sale Price</th>
								<th>TMV</th>
								<th>Date</th>
								<th>$/SqFt</th>
								<th>Sq Ft</th>
								<th>Bed</th>
								<th>Bath</th>
								<th>Garage</th>
								<th>Lot</th>
								<th>Yr Blt</th>
								<th>Stories</th>
								<th>Pool</th>
								<th>Spa</th>
								<th>Condition</th>
								<th>House Faces</th>
								<th>House Views</th>
								<th>Flooring</th>
								<th>Furnishings</th>
								<th>Financing</th>
								<th>Foreclosure</th>
								<th>Short Sale</th>
								<th>Bank Owned</th>
								<th>Original Price</th>
								<th>Days on Market</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table
					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->
		</div>
	</div>
</div>
	<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/accounting.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/userPropertyStatusOpt.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/saved.js', CClientScript::POS_END);
?>