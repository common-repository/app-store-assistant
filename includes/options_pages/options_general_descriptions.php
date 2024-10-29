<input type="hidden" name="appStore_options[checkboxedoptions]" value="use_shortDesc_on_single,use_shortDesc_on_multiple" />
<h2 class="asa_admin"><?php _e('Short Description', 'appStoreAssistant' ); ?></h2>
		
<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('Size for Posts', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[max_description]" value="<?php echo $options['max_description']; ?>" maxlength="4" />  <?php _e('Max characters', 'appStoreAssistant' ); ?><br />
</td>
</tr>
<tr valign="top">
<th scope="row"><label>Size for RSS/ATOM feed</label></th>
<td><input type="text" size="4" name="appStore_options[max_description_rss]" value="<?php echo $options['max_description_rss']; ?>" maxlength="4" />  <?php _e('Max characters', 'appStoreAssistant' ); ?>
</td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Use on pages', 'appStoreAssistant' ); ?></label></th>
<td>
<input type="checkbox" name="appStore_options[use_shortDesc_on_single]" value="yes" <?php if ($options['use_shortDesc_on_single'] == "yes") echo 'checked'; ?> /> <?php _e('with a Single Post', 'appStoreAssistant' ); ?><br />
<input type="checkbox" name="appStore_options[use_shortDesc_on_multiple]" value="yes" <?php if ($options['use_shortDesc_on_multiple'] == "yes") echo 'checked'; ?> /> <?php _e('with Multiple Posts', 'appStoreAssistant' ); ?><br />
<input type="checkbox" name="appStore_options[use_shortDesc_on_atomfeed]" value="yes" <?php if ($options['use_shortDesc_on_atomfeed'] == "yes") echo 'checked'; ?> /> <?php _e('with an ATOM Feed or List of Apps', 'appStoreAssistant' ); ?>
</td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Read More link', 'appStoreAssistant' ); ?></label></th>
<td><input type="radio" name="appStore_options[shortDesc_link]" value="button" <?php if ($options['shortDesc_link'] == "button") echo 'checked'; ?> /> <?php _e('show as button', 'appStoreAssistant' ); ?><br />
<input type="radio" name="appStore_options[shortDesc_link]" value="text" <?php if ($options['shortDesc_link'] == "text") echo 'checked'; ?> /> <?php _e('show as text', 'appStoreAssistant' ); ?><br />
<input type="radio" name="appStore_options[shortDesc_link]" value="hide" <?php if ($options['shortDesc_link'] == "hide") echo 'checked'; ?> /> <?php _e('hide link', 'appStoreAssistant' ); ?></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Default Text', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="20" name="appStore_options[shortDesc_screenshot_text]" value="<?php echo $options['shortDesc_screenshot_text']; ?>" maxlength="30" /> "<?php _e('Show Screenshots', 'appStoreAssistant' ); ?>"<br />
<input type="text" size="35" name="appStore_options[shortDesc_fullDesc_text]" value="<?php echo $options['shortDesc_fullDesc_text']; ?>" maxlength="45" /> "<?php _e('Show Full Description', 'appStoreAssistant' ); ?>"</td>
</tr>
</table>	
