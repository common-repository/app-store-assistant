<input type="hidden" name="appStore_options[checkboxedoptions]" value="ResetCacheOne,ResetCacheTwo" />
<p class="asa_admin_warning"><b><?php _e('This option will Reset ALL cached App and Product data as well as remove the downloaded images for all apps and products.', 'appStoreAssistant' ); ?></b></p>

<div class="asa_admin">
	<input type="checkbox" value="DoIt" name="appStore_options[ResetCacheOne]" /> <?php _e('I want to reset all cached app data', 'appStoreAssistant' ); ?>.<br /><br />
	<input type="checkbox" value="DoIt" name="appStore_options[ResetCacheTwo]" /> <?php _e('I know this will slow down my site as it rebuilds', 'appStoreAssistant' ); ?>.
</div>