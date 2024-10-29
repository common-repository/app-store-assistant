<input type="hidden" name="appStore_options[checkboxedoptions]" value="smaller_buy_button_iOS" />

<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('Button Colors', 'appStoreAssistant' ); ?></label></th>
<td><?php
	//define your color pickers
	$colorPickers = array(
		array('ID' => 'color_buttonStart', 'label' => __('Background Gradient Start', 'appStoreAssistant' )),
		array('ID' => 'color_buttonStop', 'label' => __('Background Gradient Stop', 'appStoreAssistant' )),
		array('ID' => 'color_buttonText', 'label' => __('Text', 'appStoreAssistant' )),
		array('ID' => 'color_buttonTextShadow', 'label' => __('Text Shadow', 'appStoreAssistant' )),
		array('ID' => 'color_buttonShadow', 'label' => __('Shadow', 'appStoreAssistant' )),
		array('ID' => 'color_buttonBorder', 'label' => __('Border', 'appStoreAssistant' )),
		array('ID' => 'color_buttonHoverStart', 'label' => __('Background Gradient Start (Hover)', 'appStoreAssistant' )),
		array('ID' => 'color_buttonHoverStop', 'label' => __('Background Gradient Stop (Hover)', 'appStoreAssistant' )),
		array('ID' => 'color_buttonHoverText', 'label' => __('Text (Hover)', 'appStoreAssistant' )),
	);

	foreach($colorPickers as $colorPicker) {
		echo "<div>\r";
		echo '<input type="text" class="color" id="'.$colorPicker['ID'].'" ';
		echo 'value="'.$options[$colorPicker['ID']].'" ';
		echo 'name="appStore_options['.$colorPicker['ID'].']" size="6" />'."\r";
		echo '<label for="'.$colorPicker['ID'].'">'.$colorPicker['label'].'</label>'."\r";
		echo '<div id="'.$colorPicker['ID'].'_color"></div>'."\r";
		echo '</div>'."\r";
	}
?>	
</td></tr>
<tr valign="top">
<th scope="row"><label><?php _e('Button Background', 'appStoreAssistant' ); ?></label></th>
<td><?php

	echo '<select name="appStore_options[hide_button_background]">';
	echo '<option value="no" ';
	if ($options['hide_button_background'] == "no") echo 'selected';
	echo '>'.__('Solid Button Background', 'appStoreAssistant' ).'</option>';
	echo '<option value="yes" ';
	if ($options['hide_button_background'] == "yes") echo 'selected';
	echo '>'.__('Transparent Button Background', 'appStoreAssistant' ).'</option>';
	echo '</select>';
?></td></tr>
<th scope="row"><label><?php _e('Button Background (Hover)', 'appStoreAssistant' ); ?></label></th>
<td><?php

	echo '<select name="appStore_options[hide_button_background_hover]">';
	echo '<option value="no" ';
	if ($options['hide_button_background_hover'] == "no") echo 'selected';
	echo '>'.__('Solid Button Background', 'appStoreAssistant' ).'</option>';
	echo '<option value="yes" ';
	if ($options['hide_button_background_hover'] == "yes") echo 'selected';
	echo '>'.__('Transparent Button Background', 'appStoreAssistant' ).'</option>';
	echo "</select>\r";
?></td></tr>
<tr valign="top">
<th scope="row"><label><?php _e('Button Border', 'appStoreAssistant' ); ?></label></th>
<td><?php
	echo __('Corner Radius', 'appStoreAssistant' ).': <input type="text" size="3" name="appStore_options[button_corner_radius]" value="'.$options['button_corner_radius'].'" />px';
	echo "<br />\r";
	echo __('Border Width', 'appStoreAssistant' ).': <input type="text" size="2" name="appStore_options[button_border_width]" value="'.$options['button_border_width'].'" />px';
?></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('iOS Button', 'appStoreAssistant' ); ?></label></th>
<td><input type="checkbox" name="appStore_options[smaller_buy_button_iOS]" value="yes" <?php if ($options['smaller_buy_button_iOS'] == "yes") echo 'checked'; ?> /> <?php _e('Show a smaller Buy Button in iOS browsers', 'appStoreAssistant' ); ?>
</td>
</tr>
</table>
