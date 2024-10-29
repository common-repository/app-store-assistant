<input type="hidden" name="appStore_options[checkboxedoptions]" value="displayexcerptthumbnail,displayexcerptreadmore" />

<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('Excerpt Generator', 'appStoreAssistant' ); ?></label></th>
<td><input type="radio" name="appStore_options[excerpt_generator]" value="wordpress" <?php if ($options['excerpt_generator'] == "wordpress") echo 'checked'; ?> /> WordPress<br />
<input type="radio" name="appStore_options[excerpt_generator]" value="asa" <?php if ($options['excerpt_generator'] == "asa") echo 'checked'; ?> /> App Store Assistant<br />
	<p class="asa_admin_warning"><?php _e('This feature may negatively affect your theme. Most themes do not expect an image in the excerpt.', 'appStoreAssistant' ); ?></p></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Max Length', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[excerpt_max_chars]" value="<?php echo $options['excerpt_max_chars']; ?>" maxlength="4" /> <?php _e('words', 'appStoreAssistant' ); ?></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Show', 'appStoreAssistant' ); ?></label></th>
<td><input type="checkbox" name="appStore_options[displayexcerptthumbnail]" value="yes" <?php if ($options['displayexcerptthumbnail'] == "yes") echo 'checked'; ?> /> <?php _e('App Icon in excerpt', 'appStoreAssistant' ); ?><br />
<input type="checkbox" name="appStore_options[displayexcerptreadmore]" value="yes" <?php if ($options['displayexcerptreadmore'] == "yes") echo 'checked'; ?> /> <?php _e('"More Info" link at end of excerpt', 'appStoreAssistant' ); ?><br />
<input type="radio" name="appStore_options[excerpt_moreinfo_link]" value="button" <?php if ($options['excerpt_moreinfo_link'] == "button") echo 'checked'; ?> /> <?php _e('More Info button', 'appStoreAssistant' ); ?><br />
<input type="radio" name="appStore_options[excerpt_moreinfo_link]" value="text" <?php if ($options['excerpt_moreinfo_link'] == "text") echo 'checked'; ?> /> <?php _e('More Info text link', 'appStoreAssistant' ); ?>
</td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Default Link Text', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="15" name="appStore_options[excerpt_moreinfo_text]" value="<?php echo $options['excerpt_moreinfo_text']; ?>" maxlength="30" /> "<?php _e('More Info', 'appStoreAssistant' ); ?>"
</td>
</tr>
</table>