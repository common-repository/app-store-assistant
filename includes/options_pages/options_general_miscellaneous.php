<input type="hidden" name="appStore_options[checkboxedoptions]" value="open_links_externally,rss_showIcon,rss_showShortDescription,enable_lightbox" />

<h2 class="asa_admin"><?php _e("Site's RSS/ATOM Feed", 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<div class="asa_admin_element"><input type="checkbox" name="appStore_options[rss_showIcon]" value="yes" <?php if ($options['rss_showIcon'] == "yes") echo 'checked'; ?> /> <?php _e('Add Item icon to feed', 'appStoreAssistant' ); ?></div>
		<div class="asa_admin_element"><input type="checkbox" name="appStore_options[rss_showShortDescription]" value="yes" <?php if ($options['rss_showShortDescription'] == "yes") echo 'checked'; ?> /> <?php _e('Add Item short description to feed', 'appStoreAssistant' ); ?></div>

	</div>
		
<h2 class="asa_admin"><?php _e('Other', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<div class="asa_admin_element"><?php _e('Affiliate Network', 'appStoreAssistant' ); ?>: <select name="appStore_options[affiliatepartnerid]">
			<option value="999" <?php if ($options['affiliatepartnerid'] == "999") echo 'selected'; ?>><?php _e('None', 'appStoreAssistant' ); ?></option>
			<option value="2013" <?php if ($options['affiliatepartnerid'] == "2013") echo 'selected'; ?>>PHG</option>
			<option value="2003" <?php if ($options['affiliatepartnerid'] == "2003") echo 'selected'; ?>>TradeDoubler</option>
			</select>
		</div>
		
		
		<div class="asa_admin_element"><input type="checkbox" name="appStore_options[enable_lightbox]" value="yes" <?php if ($options['enable_lightbox'] == "yes") echo 'checked'; ?> /> <?php _e('Enable', 'appStoreAssistant' ); ?> <a href="http://lokeshdhakar.com/projects/lightbox2/" target="_blank">Lightbox</a> </div>
		<div class="asa_admin_element"><input type="checkbox" name="appStore_options[open_links_externally]" value="yes" <?php if ($options['open_links_externally'] == "yes") echo 'checked'; ?> /> <?php _e('Open links in new window', 'appStoreAssistant' ); ?></div>
	</div>