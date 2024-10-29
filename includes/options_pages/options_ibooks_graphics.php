<h2 class="asa_admin"><?php _e('iBooks Store Badge', 'appStoreAssistant' ); ?></h2>
<table class="asa_form-table">
<tr valign="top">
<th scope="row"><label><?php _e('iBooks Store Badge Verbage', 'appStoreAssistant' ); ?></label></th>
<td><select name='appStore_options[iBooks_store_badge_type]'>
	<option value="available" <?php if ($options['iBooks_store_badge_type'] == "getit") echo 'selected'; ?>><?php _e('Get it on iBooks', 'appStoreAssistant' ); ?></option>
</select></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('iBooks Stores Badge Size', 'appStoreAssistant' ); ?></label></th>
<td><select name='iBooks_options[iBooks_store_badge_size]'>
	<option value=".5" <?php if ($options['iBooks_store_badge_size'] == ".5") echo 'selected'; ?>>Half</option>
	<option value="1" <?php if ($options['iBooks_store_badge_size'] == "1") echo 'selected'; ?>>Full Size</option>
	<option value="1.5" <?php if ($options['iBooks_store_badge_size'] == "1.5") echo 'selected'; ?>>1.5x</option>
	<option value="2" <?php if ($options['iBooks_store_badge_size'] == "2") echo 'selected'; ?>>2x</option>
	<option value="2.5" <?php if ($options['iBooks_store_badge_size'] == "2.5") echo 'selected'; ?>>2.5x</option>
	
</select> * Full Size is 110px x 40px</td>
</tr>

</table>	
