<p><?php _e('The sizes below set the Maximum size for an image. Most iOS and Mac app icons will be exactly the sizes you set, but most iTunes images only come in smaller sizes. Product images from amazon.com vary in size. You also have the option to <b>Crop</b> an image to fit your exact dimensions or to keep the <b>Aspect</b> ratio and fit <u>within</u> your dimensions.', 'appStoreAssistant' ); ?></p>

<p class="asa_admin_warning">(<?php _e('Cached app data must be cleared for change to take effect', 'appStoreAssistant' ); ?>. See <b><a href="<?php echo admin_url()."admin.php?page=appStore_sm_utilities&tab=clearcache"; ?>"><?php _e('Utilities', 'appStoreAssistant' ); ?> -> <?php _e('Clear Cache', 'appStoreAssistant' ); ?></a></b>.)</p>

<table class="form-table" style="width:auto;">
<tr><td></td><td><?php _e('Height', 'appStoreAssistant' ); ?></td><td><?php _e('Width', 'appStoreAssistant' ); ?></td><td><?php _e('Aspect', 'appStoreAssistant' ); ?></td><td><?php _e('Crop', 'appStoreAssistant' ); ?></td></tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for Featured Image', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_featured_h]" value="<?php echo $options['appicon_size_featured_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_featured_w]" value="<?php echo $options['appicon_size_featured_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_featured_c]" value="0" <?php if ($options['appicon_size_featured_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_featured_c]" value="1" <?php if ($options['appicon_size_featured_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for iOS Browsers', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_ios_h]" value="<?php echo $options['appicon_size_ios_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_ios_w]" value="<?php echo $options['appicon_size_ios_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_ios_c]" value="0" <?php if ($options['appicon_size_ios_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_ios_c]" value="1" <?php if ($options['appicon_size_ios_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for Lists', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_lists_h]" value="<?php echo $options['appicon_size_lists_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_lists_w]" value="<?php echo $options['appicon_size_lists_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_lists_c]" value="0" <?php if ($options['appicon_size_lists_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_lists_c]" value="1" <?php if ($options['appicon_size_lists_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for Posts', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_posts_h]" value="<?php echo $options['appicon_size_posts_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_posts_w]" value="<?php echo $options['appicon_size_posts_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_posts_c]" value="0" <?php if ($options['appicon_size_posts_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_posts_c]" value="1" <?php if ($options['appicon_size_posts_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for Elements', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_element_h]" value="<?php echo $options['appicon_size_element_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_element_w]" value="<?php echo $options['appicon_size_element_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_element_c]" value="0" <?php if ($options['appicon_size_element_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_element_c]" value="1" <?php if ($options['appicon_size_element_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for Widgets', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_widget_h]" value="<?php echo $options['appicon_size_widget_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_widget_w]" value="<?php echo $options['appicon_size_widget_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_widget_c]" value="0" <?php if ($options['appicon_size_widget_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_widget_c]" value="1" <?php if ($options['appicon_size_widget_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for RSS/ATOM feeds', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_rss_h]" value="<?php echo $options['appicon_size_rss_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_rss_w]" value="<?php echo $options['appicon_size_rss_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_rss_c]" value="0" <?php if ($options['appicon_size_rss_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_rss_c]" value="1" <?php if ($options['appicon_size_rss_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for iPhone Screenshots', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_iphoness_h]" value="<?php echo $options['appicon_size_iphoness_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_iphoness_w]" value="<?php echo $options['appicon_size_iphoness_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_iphoness_c]" value="0" <?php if ($options['appicon_size_iphoness_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_iphoness_c]" value="1" <?php if ($options['appicon_size_iphoness_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for iPad Screenshots', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_ipadss_h]" value="<?php echo $options['appicon_size_ipadss_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_ipadss_w]" value="<?php echo $options['appicon_size_ipadss_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_ipadss_c]" value="0" <?php if ($options['appicon_size_ipadss_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_ipadss_c]" value="1" <?php if ($options['appicon_size_ipadss_c'] == "1") echo 'checked'; ?> /></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Image size for Amazon.com Items', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="4" name="appStore_options[appicon_size_amazon_h]" value="<?php echo $options['appicon_size_amazon_h']; ?>" />px</td>
<td><input type="text" size="4" name="appStore_options[appicon_size_amazon_w]" value="<?php echo $options['appicon_size_amazon_w']; ?>" />px</td>
<td><input type="radio" name="appStore_options[appicon_size_amazon_c]" value="0" <?php if ($options['appicon_size_amazon_c'] == "0") echo 'checked'; ?> /></td>
<td><input type="radio" name="appStore_options[appicon_size_amazon_c]" value="1" <?php if ($options['appicon_size_amazon_c'] == "1") echo 'checked'; ?> /></td>
</tr>
</table>