<div id="wfg_setting" class="wrap">
	<div class="header clearfix">
		<div class="left">
			<?php
				echo '<img src="' . plugins_url( 'img/wfg-logo.png', dirname(__FILE__) ) . '" > ';
			?>
		</div>
		<div class="left">
			<h1><?php echo WFG_Common_Helper::translate('WooCommerce Multiple Free Gift') ?> </h1>
		</div>
		<div class="right"></div>
	</div>
	<?php $products = WFG_Product_Helper::get_products(); ?>
	<div id="wfg_free_gift_global_settings">
		<form name="wfg_main_menu_form" method="post" action="">
			<h2></h2>
			<?php wp_nonce_field('wfg_global_settings','_wfg_global_nonce'); ?>
			<?php if( $products->have_posts() ): ?>
				<div class="options_group">
					<p class="form-field wfg_form_field switcher ">
						<?php
							$checked = '';
							if( WFG_Settings_Helper::get('global_enabled', true, 'global_options') ) {
								$checked = 'checked';
							}
						?>
						<span><?php echo WFG_Common_Helper::translate('Enable/Disable free gift') ?></span>
						<label class="wfg_globally_enabled switch switch-green">
							<input type="checkbox" class="checkbox switch-input"  name="wfg_globally_enabled" id="wfg_globally_enabled" <?php echo $checked ?>>
							<span class="switch-label" data-on="On" data-off="Off"></span>
							<span class="switch-handle"></span>
						</label>
					</p>
				</div>

				<div class="wfg-main-settings-wrapper">
					<?php
						$wfg_global_settings = WFG_Settings_Helper::get('', false, 'global_settings', false);
						$condition = isset($wfg_global_settings['criteria-1']) ? $wfg_global_settings['criteria-1'] : null;
					?>
					<div class="wfg-settings-repeater shadow" data-id="1">
						<div class="wfg-draggable">
							<p class="form-field wfg_form_field">
								<label for="wfg_gifts_allowed" class="description">
									<?php echo WFG_Common_Helper::translate('Number of gifts allowed'); ?>
								</label>
								<input type="text" class="input-text input-small" name="_wfg_criteria[criteria-1][num_allowed]" value="<?php echo !empty($condition['num_allowed']) ? $condition['num_allowed'] : 1 ?>" />				
							</p>
							<p>
							<label for="wfg_gift_criteria" class="description adjust-right-gap">
								<?php echo WFG_Common_Helper::translate('Select Gift criteria'); ?>
							</label>
							<?php $wfg_gift_criteria = WFG_Settings_Helper::get('', false, 'criteria', false); ?>
								<select name="_wfg_criteria[criteria-1][condition]">
									<option value=""><?php echo WFG_Common_Helper::translate('None') ?></option>
									<?php
										if( !empty($wfg_gift_criteria) ) {
											foreach( $wfg_gift_criteria as $criteria ) {
												$selected = '';
												if( $criteria['slug'] == $condition['condition'] ) {
													$selected = 'selected';
												}

												echo '<option value="' . $criteria['slug']  .'" ' . $selected . '>' . $criteria['name'] . '</option>';
											}
										}
									?>
								</select>
							</p>
						</div>
						<hr class="wfg-hr">
						<p>
							<label><?php echo WFG_Common_Helper::translate('Select Gift Products') ?></label>
						</p>
						<div class="_wfg-repeat">
							<?php
								if( !empty($condition['items']) ):
									foreach( $condition['items'] as $k => $item ):
							?>
								<p class="wfg-inputs wfg-criteria-options-wrap">
									<?php
										if( $products->have_posts() ) {
											echo "<select class='wfg-single-gift wfg-input-large' name='_wfg_criteria[criteria-1][items][]'>";
											while( $products->have_posts() ) {
												$products->the_post();
												$selected = '';
												if( $item == get_the_ID() ) {
													$selected = 'selected';
												}

												echo "<option value='" . get_the_ID() . "' {$selected}>" . get_the_title() . "</option>";
											}
											echo "</select>";
										}
									
									if( $k > 0 ): ?>
										<a class="wfg-remove-condition-criteria dashicons dashicons-no" href="javascript:void(0)"></a>
									<?php endif; ?>
								</p>
							<?php
									endforeach;
								else:
							?>
								<p class="wfg-inputs wfg-criteria-options-wrap">
									<?php
										if( $products->have_posts() ) {
											echo "<select class='wfg-single-gift wfg-input-large' name='_wfg_criteria[criteria-1][items][]'>";
											while( $products->have_posts() ) {
												$products->the_post();
												$selected = '';
												if( $item == get_the_ID() ) {
													$selected = 'selected';
												}

												echo "<option value='" . get_the_ID() . "' {$selected}>" . get_the_title() . "</option>";
											}
											echo "</select>";
										}
									?>
								</p>

							<?php
								endif;
							?>
						</div>

						<div class="options_group">
							<p>
								<button type="button" class="wfg_product_add button"><?php echo WFG_Common_Helper::translate('Add new gift') ?></button>
							</p>
						</div>
					</div>
				</div>

				<input type="hidden" name="_wfg_global_hidden" value="Y" />
				<button class="button button-primary" type="submit"><?php echo WFG_Common_Helper::translate('Save') ?></button>
			<?php else: ?>
				<div class="options_group">
					<p class="wfg-info-wrapper form-field wfg_form_field switcher">
						<?php echo get_permalink( woocommerce_get_page_id( 'product' ) ) ?>
						<?php
							$message = WFG_Common_Helper::translate('Please add some');
							$message .= ' ';
							$message .= '<a href="edit.php?post_type=product">' . WFG_Common_Helper::translate('products') . '</a>';
							$message .= ' ';
							$message .= WFG_Common_Helper::translate('first.');
							echo $message;
						?>
					</p>
				</div>
			<?php endif; ?>
		</form>
	</div>
</div>
