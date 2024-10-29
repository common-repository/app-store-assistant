<p class="asa_admin_explain">
<?php _e('Amazon.com requires you have your own AWS Public and Private Keys. You can get the keys by signing up at', 'appStoreAssistant' ); ?>
 <a href="http://aws-portal.amazon.com/gp/aws/developer/account/index.html">http://aws-portal.amazon.com/gp/aws/developer/account/index.html</a>.</p>

<p class="asa_admin_explain"><?php _e('For step by step instrunctions on where to find all these keys and IDs, click here:', 'appStoreAssistant' ); ?>
 <b><a href="<?php echo admin_url()."admin.php?page=appStore_sm_help&tab=amazon"; ?>">Amazon.com Help</a></b>
</p>
		
<table class="form-table">
<tr valign="top">
<th scope="row"><label><?php _e('Access Key ID', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="50" name="appStore_options[AWS_API_KEY]" value="<?php echo $options['AWS_API_KEY']; ?>"/></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Secret Access Key', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="50" name="appStore_options[AWS_API_SECRET_KEY]" value="<?php echo $options['AWS_API_SECRET_KEY']; ?>"/></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Amazon.com Affiliate Code', 'appStoreAssistant' ); ?></label></th>
<td><input type="text" size="20" maxsize="50" name="appStore_options[AWS_ASSOCIATE_TAG]" value="<?php echo $options['AWS_ASSOCIATE_TAG']; ?>"/> <small>(optional)</small></td>
</tr>
<tr valign="top">
<th scope="row"><label><?php _e('Your Amazon Locale (Region)', 'appStoreAssistant' ); ?></label></th>
<td><select name='appStore_options[AWS_PARTNER_DOMAIN]'>
	<option value="com" <?php if ($options['AWS_PARTNER_DOMAIN'] == "com") echo 'selected'; ?>>US (default)</option>
	<option value="ca" <?php if ($options['AWS_PARTNER_DOMAIN'] == "ca") echo 'selected'; ?>>Canada</option>
	<option value="co.uk" <?php if ($options['AWS_PARTNER_DOMAIN'] == "co.uk") echo 'selected'; ?>>United Kingdom</option>
	<option value="de" <?php if ($options['AWS_PARTNER_DOMAIN'] == "de") echo 'selected'; ?>>Germany</option>
	<option value="com"><?php _e('Klingon Homeworld', 'appStoreAssistant' ); ?></option>
	<option value="fr" <?php if ($options['AWS_PARTNER_DOMAIN'] == "fr") echo 'selected'; ?>>France</option>
	<option value="jp" <?php if ($options['AWS_PARTNER_DOMAIN'] == "jp") echo 'selected'; ?>>Japan Yen</option>
</select></td>
</tr>
</table>	
