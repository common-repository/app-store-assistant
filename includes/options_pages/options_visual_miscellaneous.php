<input type="hidden" name="appStore_options[textboxoptions]" value="PrePositionNumber,PostPositionNumber,displayATOMappPositionNumber" />

<h2 class="asa_admin"><?php _e('Screenshots', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<div class="asa_admin_element"><label><?php _e('Screenshot Width', 'appStoreAssistant' ); ?></label><input type="text" size="3" maxlength="3" name="appStore_options[ss_size]" value="<?php echo $options['ss_size']; ?>" />px<br />
	<p class="asa_admin_explain">(in px. <?php _e('Height is automatic.', 'appStoreAssistant' ); ?>)</p>
		</div>
	</div>

<h2 class="asa_admin"><?php _e('ATOM/RSS Feeds', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<div class="asa_admin_element"><?php _e('Display', 'appStoreAssistant' ); ?> <input type="text" size="3" name="appStore_options[qty_of_apps]" value="<?php echo $options['qty_of_apps']; ?>" maxlength="3" /> <?php _e('apps from ATOM feed', 'appStoreAssistant' ); ?></div>
		<div class="asa_admin_element"><?php _e('Character(s) Before Position Number', 'appStoreAssistant' ); ?> <input type="text" size="3" name="appStore_options[PrePositionNumber]" value="<?php if ($options['PrePositionNumber'] != "EMP") echo $options['PrePositionNumber']; ?>" maxlength="3" /></div>
		<div class="asa_admin_element"><?php _e('Character(s) After Position Number', 'appStoreAssistant' ); ?> <input type="text" size="3" name="appStore_options[PostPositionNumber]" value="<?php if ($options['PostPositionNumber'] != "EMP") echo $options['PostPositionNumber']; ?>" maxlength="3" /></div>

	<div class="asa_admin_element"><?php _e('Display Position Number in lists', 'appStoreAssistant' ); ?> <input type="checkbox" name="appStore_options[displayATOMappPositionNumber]" value="yes" <?php if ($options['displayATOMappPositionNumber'] == "yes") echo 'checked'; ?> /></div>

	</div>

