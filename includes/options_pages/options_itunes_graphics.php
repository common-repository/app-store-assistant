<h2 class="asa_admin"><?php _e('iTunes Store Badge', 'appStoreAssistant' ); ?></h2>
<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('iTunes Store Badge Verbage', 'appStoreAssistant' ); ?></label></th>
<td><select name='appStore_options[iTunes_store_badge_type]'>
	<option value="available" <?php if ($options['iTunes_store_badge_type'] == "available") echo 'selected'; ?>><?php _e('Available on iTunes', 'appStoreAssistant' ); ?></option>
	<option value="download" <?php if ($options['iTunes_store_badge_type'] == "download") echo 'selected'; ?>><?php _e('Download on iTunes', 'appStoreAssistant' ); ?></option>
</select></td>
</tr>
</table>	
