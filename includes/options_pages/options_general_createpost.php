<input type="hidden" name="appStore_options[checkboxedoptions]" value="newPost_addCategories,newPost_defaultTextShow,newPost_createCategories" />
<p><?php _e('These are the setting for the New App Post button. They are used when you search for and create a Post', 'appStoreAssistant' ); ?>.</p>

<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('Create New posts as', 'appStoreAssistant' ); ?></label></th>
<td><input type="radio" name="appStore_options[newPost_status]" value="draft" <?php if ($options['newPost_status'] == "draft") echo 'checked'; ?> /> Draft<br />
<input type="radio" name="appStore_options[newPost_status]" value="publish" <?php if ($options['newPost_status'] == "publish") echo 'checked'; ?> /> Publish<br />
<input type="radio" name="appStore_options[newPost_status]" value="pending" <?php if ($options['newPost_status'] == "pending") echo 'checked'; ?> /> Pending
</td></tr>
<tr valign="top">
<th scope="row"><label><?php _e('Categories', 'appStoreAssistant' ); ?></label></th>
<td><input type="checkbox" name="appStore_options[newPost_addCategories]" value="yes" <?php if ($options['newPost_addCategories'] == "yes") echo 'checked'; ?> /> <?php _e('Add App Store categories to post', 'appStoreAssistant' ); ?><br />
<input type="checkbox" name="appStore_options[newPost_createCategories]" value="yes" <?php if ($options['newPost_createCategories'] == "yes") echo 'checked'; ?> /> <?php _e("Create categories if they don't adread exist", 'appStoreAssistant' ); ?>
</td></tr>
<tr valign="top">
<th scope="row"><label><?php _e('More Info', 'appStoreAssistant' ); ?></label></th>
<td><input type="checkbox" name="appStore_options[newPost_defaultTextShow]" value="yes" <?php if ($options['newPost_defaultTextShow'] == "yes") echo 'checked'; ?> /> <?php _e('Add "more_info_text" attribute to shortcode', 'appStoreAssistant' ); ?><br />
<?php _e('Default More Info Text', 'appStoreAssistant' ); ?>: <input type="text" size="15" name="appStore_options[newPost_defaultText]" value="<?php echo $options['newPost_defaultText']; ?>" maxlength="30" />
</td></tr>
</table>
