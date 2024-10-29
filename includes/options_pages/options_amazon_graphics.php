<h2 class="asa_admin"><?php _e('Amazon.com Badge', 'appStoreAssistant' ); ?></h2>
<table class="asa_form-table">
<tr valign="top">
<th scope="row"><label><?php _e('Amazon.com Badge Verbage', 'appStoreAssistant' ); ?></label></th>
<td><select name='appStore_options[amazon_badge_type]'>
	<option value="available" <?php if ($options['amazon_badge_type'] == "getit") echo 'selected'; ?>><?php _e('Get it on Amazon.com', 'appStoreAssistant' ); ?></option>
</select></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Amazon.com Badge Size', 'appStoreAssistant' ); ?></label></th>
<td><select name='amazon_options[amazon_badge_size]'>
	<option value=".5" <?php if ($options['amazon_badge_size'] == ".5") echo 'selected'; ?>>Half</option>
	<option value="1" <?php if ($options['amazon_badge_size'] == "1") echo 'selected'; ?>>Full Size</option>
	<option value="1.5" <?php if ($options['amazon_badge_size'] == "1.5") echo 'selected'; ?>>1.5x</option>
	<option value="2" <?php if ($options['amazon_badge_size'] == "2") echo 'selected'; ?>>2x</option>
	<option value="2.5" <?php if ($options['amazon_badge_size'] == "2.5") echo 'selected'; ?>>2.5x</option>
	
</select> * Full Size is 215px x 74px</td>
</tr>

</table>	
