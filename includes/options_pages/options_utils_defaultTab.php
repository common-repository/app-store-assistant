<input type="hidden" name="appStore_options[checkboxedoptions]" value="RemoveCachedItem" />
<p class="asa_admin_warning"><b><?php _e('If you are having trouble with a specific item such as the image not loading or it is showing the wrong price or info, then you can have the system refresh the data. Just enter the ASIN or App ID below.', 'appStoreAssistant' ); ?></b></p>

<input type="checkbox" value="DoIt" name="appStore_options[RemoveCachedItem]" /> <?php _e('I want to remove the cached data for the item listed below', 'appStoreAssistant' ); ?>.<br /><br />

<table class="form-table">
<tr valign="top">
<th scope="row"><label>App or iTunes ID</label></th>
<td><input type="text" size="15" name="appStore_options[RemoveCachedItemID]" value="" /></td>
</tr>
<tr valign="top">
<th scope="row"><label>Amazon.com ASIN</label></th>
<td><input type="text" size="15" name="appStore_options[RemoveCachedItemASIN]" value="" /></td>
</tr>
</table>	
