<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('App Stores Badge Verbage', 'appStoreAssistant' ); ?></label></th>
<td><select name='appStore_options[appStore_store_badge_type]'>
	<option value="available" <?php if ($options['appStore_store_badge_type'] == "available") echo 'selected'; ?>><?php _e('Available on the App Store', 'appStoreAssistant' ); ?></option>
	<option value="download" <?php if ($options['appStore_store_badge_type'] == "download") echo 'selected'; ?>><?php _e('Download on the App Store', 'appStoreAssistant' ); ?></option>
</select></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('iDevice List icon style', 'appStoreAssistant' ); ?></label></th>
<td><?php
		echo '<select name="appStore_options[displayappdetailsasliststyle]">';
		echo '<option value="bw" ';
		if ($options['displayappdetailsasliststyle'] == "bw") echo 'selected';
		echo '>'.__('B&W Icons', 'appStoreAssistant' ).'</option>';
		echo '<option value="color" ';
		if ($options['displayappdetailsasliststyle'] == "color") echo 'selected';
		echo '>'.__('Color Icons', 'appStoreAssistant' ).'</option>';
		echo '</select>';
	?>
</td>
</tr>

<tr valign="top">
<th scope="row" nobr><label><?php _e('Supported Devices Single Post', 'appStoreAssistant' ); ?></label></th>
<td><?php
		echo '<select name="appStore_options[displaysupporteddevicesType]">';
		echo '<option value="List" ';
		if ($options['displaysupporteddevicesType'] == "List") echo 'selected';
		echo '>'.__('Text List', 'appStoreAssistant' ).'</option>';
		echo '<option value="Minimal" ';
		if ($options['displaysupporteddevicesType'] == "Minimal") echo 'selected';
		echo '>'.__('Minimal Icons', 'appStoreAssistant' ).'</option>';
		echo '<option value="Normal" ';
		if ($options['displaysupporteddevicesType'] == "Normal") echo 'selected';
		echo '>'.__('Normal Icons', 'appStoreAssistant' ).'</option>';
		echo '</select>';
	?></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Supported Devices Multiple Posts', 'appStoreAssistant' ); ?></label></th>
<td><?php
		echo '<select name="appStore_options[displaympsupporteddevicesType]">';
		echo '<option value="List" ';
		if ($options['displaympsupporteddevicesType'] == "List") echo 'selected';
		echo '>'.__('Text List', 'appStoreAssistant' ).'</option>';
		echo '<option value="Minimal" ';
		if ($options['displaympsupporteddevicesType'] == "Minimal") echo 'selected';
		echo '>'.__('Minimal Icons', 'appStoreAssistant' ).'</option>';
		echo '<option value="Normal" ';
		if ($options['displaympsupporteddevicesType'] == "Normal") echo 'selected';
		echo '>'.__('Normal Icons', 'appStoreAssistant' ).'</option>';
		echo '</select>';
	?>
</td>
</tr>
</table>