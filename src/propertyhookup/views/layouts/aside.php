<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span>  <!-- User image size is adjusted inside CSS, it should stay as it --> 
            <?php $user_first_name = !empty($profile->first_name) ? $profile->first_name : Yii::app()->user->username; ?>
            <?php $user_last_name = !empty($profile->last_name) ? $profile->last_name : ''; ?>
            <?php
            
            $cdnImages = Yii::app()->params['cdnImages'];
            if(!empty($cdnImages)) {
                $filename = !empty($profile->upload_photo) ?
                        CPathCDN::baseurl( 'images' ) . '/images/avatars/50_50_' . $profile->upload_photo:
                        CPathCDN::baseurl( 'images' ) . '/images/avatars/male.png';
            } else {
                $filename = !empty($profile->upload_photo) ?
                        (file_exists(Yii::app()->basePath."/../images/avatars/50_50_". $profile->upload_photo)? 
                        CPathCDN::baseurl( 'images' ) . '/images/avatars/50_50_' . $profile->upload_photo:
                        CPathCDN::baseurl( 'images' ) . '/images/avatars/male.png') :
                        CPathCDN::baseurl( 'images' ) . '/images/avatars/male.png';
            }            
            ?>
            <img src="<?php echo $filename; ?>" alt="me" class="online" />

            <a href="javascript:void(0);" id="show-shortcut"><?php echo $user_first_name . "&nbsp;" . $user_last_name; ?><i class="fa fa-angle-down"></i></a>  </span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->

				<ul>
					<?php
					if(SiteHelper::forFullPaidMembersOnly(true) !== true){ ?>
						<li>
							<a href="<?php echo Yii::app()->params['linkToBuyingSubscr'];?>" class="unlock-link"><i class="fa fa-lg fa-fw fa-unlock"></i><span class="menu-item-parent">Full Access</span></a>
						</li>
					<?php } ?>
<!--					<li>-->
<!--						<a id="dashboard_menu" href="index.html" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>-->
<!--					</li>-->
					<li>
						<a id="myprofile" href="<?php echo Yii::app()->createUrl('user/profile', $params = array())?>"><i class="fa fa-lg fa-fw fa-pencil-square-o"></i> <span class="menu-item-parent">My Profile</span></a>
<?php /*/ ?>
                                                <ul>
							<li>
								<a id="editmyprofile" href="/user/profile">Edit My Profile<span class="badge pull-right inbox-badge bg-color-orange">95% Complete</span></a>
							</li>
							<li>
                                                                <a id="upload_photo_menu" href="dropzone.html">Upload Photos <span class="badge pull-right inbox-badge bg-color-red">None</span></a>
							</li>
							<li>
                                                                <a id="upgrade_account_menu" href="form-templates.html">Upgrade My Account<span class="badge pull-right inbox-badge bg-color-red">Here</span></a>
							</li>
							<li>
								<a id="beacon_menu" href="validation.html">Beacon</a>
							</li>
							<li>
								<a id="spot_light_menu" href="bootstrap-forms.html">SpotLight</a>
							</li>
							<li>
								<a id="halo_menu" href="plugins.html">Halo</a>
							</li>
							<li>
								<a id="wizard_menu" href="wizard.html">Wizard</a>
							</li>
							<li>
								<a id="ray_menu" href="other-editors.html">Ray</a>
							</li>
						</ul>
<?php /*/ ?>
					</li>
					<li>
						<a href="<?php echo Yii::app()->createUrl('property/search');?>"><i class="fa fa-lg fa-fw fa-search"></i> <span class="menu-item-parent">Search</span></a>
					</li>
					<li>
						<a id="searches_alerts_menu" href="<?php echo Yii::app()->createUrl('searches/alerts', $params = array())?>">
                            <i class="fa fa-lg fa-fw fa-bell"></i>
                            <span class="menu-item-parent">Searches / Alerts</span>
                            <!--<span class="badge pull-right inbox-badge bg-color-green txt-color-white">4</span>-->
                        </a>
					</li>
					<li>
						<a id="saved_alerts_menu" href="<?php echo Yii::app()->createUrl('saved/properties', $params = array())?>">
							<i class="fa fa-lg fa-fw fa-heart"></i>
							<span class="menu-item-parent">Saved Properties</span>
							<!--<span class="badge pull-right inbox-badge bg-color-green txt-color-white">4</span>-->
						</a>
					</li>
<?php /*					<li>
						<a id="value_analitics_menu" href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Value Analytics</span></a>
						<ul>
							<li>
								<a id="propery_comparison_menu"  href="flot.html">Property Comparison</a>
							</li>
							<li>
								<a id="market_lab_menu" href="morris.html">Market Lab</a>
							</li>
							<li>
								<a id="wave_menu" href="inline-charts.html">Irradii Wave</a>
							</li>
						</ul>
					</li>
					<li>
						<a id="agents_vendors_menu" href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Agents / Vendors</span></a>
						<ul>
							<li>
								<a id="saved_agents_profiles_menu" href="general-elements.html">Saved Agent Profiles</a>
							</li>
							<li>
								<a id="saved_vendor_profiles_menu" href="buttons.html">Saved Vendor Profiles</a>
							</li>
						</ul>
					</li>
*/ ?>
<?php /*/ ?>
					<li>
						<a id="my_properties_menu" href="#"><i class="fa fa-lg fa-fw fa-map-marker"></i> <span class="menu-item-parent">My Properties</span></a>
						<ul>
							<li>
								<a id="my_listings_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> My Listings</a>
								<ul>
									<li>
										<a id="active_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> Active </a>
										<ul>
											<li>
												<a id="active_file_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											<li>
												<a id="active_file2_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											
										</ul>
									</li>
									<li>
										<a id="archive_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> Archive </a>
										<ul>
											<li>
												<a id="archive_file_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											<li>
												<a id="archive_file2_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											
										</ul>
									</li>
								</ul>
							</li>
							<li>
												<a id="post_new_listing_menu" href="dropzone.html"><i class="fa fa-fw fa-flag"></i> Post New Listing</a>
							</li>
							<li>
								<a id="saved_properties_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> Saved Properties</a>

								<ul>
									<li>
										<a id="third_level_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> 3rd Level </a>
										<ul>
											<li>
												<a id="third_level_file_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											<li>
												<a id="third_level_file2_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
										</ul>
									</li>
								</ul>

							</li>
						</ul>
					</li>
					<li>
						<a id="auction_watch_menu" href="calendar.html"><i class="fa fa-lg fa-fw fa-calendar"><em>3</em></i> <span class="menu-item-parent">Auction Watch</span></a>
					</li>
					<li>
						<a id="beacon2_menu" href="#"><i class="fa fa-lg fa-fw fa-clock-o text-warning"></i> <span class="menu-item-parent text-warning">Beacon</span></a>
						<ul>
							<li>
								<a id="you_visited_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> You Visited: <br>
								Las Vegas Foreclosures on 3/14</a>
								<ul>
									<li>
										<a id="visited1_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> Las Vegas </a>
										<ul>
											<li>
												<a id="visited2_menu" href="#"><i class="fa fa-fw fa-file-text"></i> 89119 on 3-14</a>
											</li>
											<li>
												<a id="visited3_menu" href="#"><i class="fa fa-fw fa-file-text"></i> Foreclosures for sale</a>
											</li>
											<li>
												<a id="visited4_menu" href="#"><i class="fa fa-fw fa-file-text"></i> More...</a>
											</li>
											
										</ul>
									</li>
									<li>
										<a id="visited5_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> Foreclosures </a>
										<ul>
											<li>
												<a id="visited6_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											<li>
												<a id="visited7_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											
										</ul>
									</li>
								</ul>
							</li>
							<li>
								<a id="market_data_menu" href="dropzone.html"><i class="fa fa-fw fa-signal"></i> Market Data</a>
							</li>
							<li>
								<a id="saved_properties2_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> Saved Properties</a>

								<ul>
									<li>
										<a id="third_level2_menu" href="#"><i class="fa fa-fw fa-folder-open"></i> 3rd Level </a>
										<ul>
											<li>
												<a id="third_level2_file_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
											<li>
												<a id="third_level2_file2_menu" href="#"><i class="fa fa-fw fa-file-text"></i> File</a>
											</li>
										</ul>
									</li>
								</ul>

							</li>
						</ul>
					</li>
<?php /*/ ?>
					<?php if(SiteHelper::isAdmin()) : ?>
        				<li>
						<a id="admins_menu" href="#"><i class="fa fa-lg fa-fw fa-medkit"></i> <span class="menu-item-parent">Admins</span></a>
						<ul>
							<li>
								<a id="adclient_menu" href="#"> Ad Clients </a>
								<ul>
									<li>
										<a id="adclient_1_menu" href="<?php echo Yii::app()->createUrl('adclient/activity/admin', $params = array())?>"> Manage Ad Client Activities </a>
									</li>
									<li>
										<a id="adclient_2_menu" href="<?php echo Yii::app()->createUrl('adclient/adclient/admin', $params = array())?>"> Manage Ad Clients </a>
									</li>
									<li>
										<a id="adclient_3_menu" href="<?php echo Yii::app()->createUrl('adclient/adclient/create', $params = array())?>"> Create Ad Client </a>
									</li>
								</ul>
							</li>
							<li>
								<a id="meta_tags_admins_menu" href="<?php echo Yii::app()->createUrl('yiiseo/seo', $params = array())?>">Meta tags</a>
							</li>
							<li>
								<a id="statistic_admins_menu" href="<?php echo Yii::app()->createUrl('statInfo', $params = array())?>">Statistics</a>
							</li>
							<li>
								<a id="history_admins_menu" href="<?php echo Yii::app()->createUrl('statInfo/history', $params = array())?>">Property History</a>
							</li>
							<li>
								<a id="factors_admins_menu" href="<?php echo Yii::app()->createUrl('statInfo/factor', $params = array())?>">Factors</a>
							</li>
							<li>
								<a id="blog_menu" href="#"> Blog </a>
								<ul>
									<li>
										<a id="blog_1_menu" href="<?php echo Yii::app()->createUrl('blog', $params = array())?>"> Posts </a>
									</li>
									<li>
										<a id="blog_2_menu" href="<?php echo Yii::app()->createUrl('blog/post/admin', $params = array())?>"> Manage Posts </a>
									</li>
									<li>
										<a id="blog_3_menu" href="<?php echo Yii::app()->createUrl('blog/post/create', $params = array())?>"> Create Post </a>
									</li>
								</ul>
							</li>
							<li>
								<a id="landing_menu" href="#"> Landing Pages </a>
								<ul>
									<li>
										<a id="landing_1_menu" href="<?php echo Yii::app()->createUrl('landing', $params = array())?>"> Landing Pages </a>
									</li>
									<li>
										<a id="landing_2_menu" href="<?php echo Yii::app()->createUrl('landing/page/admin', $params = array())?>"> Manage Landing Pages </a>
									</li>
									<li>
										<a id="landing_3_menu" href="<?php echo Yii::app()->createUrl('landing/page/create', $params = array())?>"> Create Landing Page </a>
									</li>
								</ul>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('membership/membership/searchMembership')?>">User Subscriptions</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->createUrl('statInfo/uploadalertsmessages')?>">Email Alerts Messages</a>
							</li>
						</ul>
					</li>
                                        <?php endif; ?>
				</ul>
			</nav>
			<span class="minifyme" rel="tooltip" data-placement="right" data-original-title="Full Menu"> <i class="fa fa-arrow-circle-left hit"></i> </span>


		</aside>
