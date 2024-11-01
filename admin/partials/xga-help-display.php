
<div class="content-wrap">
	<div class="xgp-product-quick-view-settings">
		<div class="settings-area-wrapper">
			<h2 class="title"><?php _e('Documentation , Support And Video Tutorial','xg-accordion');?></h2>
			<span class="help-text"><?php _e('here you find online documentation , support , live demo and video tutorial.','xg-accordion')?></span>
			<?php if ( isset( $_GET['settings-updated'] ) ) {
				echo "<div class='updated margin-top-20 margin-left-0'><p>".__(' Settings Updated Successfully.','xg-accordion')."</p></div>";
			} ?>

			<div id="xgp_tabs" class="margin-top-50">
				<div class="xgp-tab-container">
					<div id="styling">
						<div class="styling-content-wrapper">
							<div class="help-block-wrapper">
								<div class="main-row">
									<div class="col-lg-4">
										<div class="xgp-panel">
											<div class="icon">
												<i class="flaticon-support"></i>
											</div>
											<div class="content">
												<h4 class="title"><?php esc_html_e('Need Any Help ?','xg-accordion')?></h4>
												<p><?php esc_html_e('We are always ready to support you and solved your problem as soon as possible.','xg-accordion')?></p>
												<a href="<?php echo esc_url('https://codecanyon.net/user/xgenious')?>" class="action-btn" target="_blank"><?php esc_html_e('Contact Support','xg-accordion')?></a>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="xgp-panel">
											<div class="icon">
												<i class="flaticon-writing"></i>
											</div>
											<div class="content">
												<h4 class="title"><?php esc_html_e('Read Documentation ?','xg-accordion')?></h4>
												<p><?php esc_html_e('We have detailed documentation on every aspects of XG Accordion.'.'xg-accordion')?></p>
												<a href="<?php echo esc_url('https://plugins.xgenious.com/faq/doc')?>" target="_blank" class="action-btn"><?php esc_html_e('Read Documentation','xg-accordion')?></a>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="xgp-panel">
											<div class="icon">
												<i class="flaticon-application-window-with-text"></i>
											</div>
											<div class="content">
												<h4 class="title"><?php esc_html_e('Live Demo ?','xg-accordion')?></h4>
												<p><?php esc_html_e('If you want to see live demo of xg accordion.click below and see all live demo .','xg-accordion')?></p>
												<a href="<?php echo esc_url('https://plugins.xgenious.com/faq')?>" target="_blank" class="action-btn"><?php esc_html_e('View Demo','xg-accordion')?></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>