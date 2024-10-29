<input type="hidden" name="appStore_options[checkboxedoptions]" value="ResetFIOne,ResetFITwo" />
<p class="asa_admin_warning"><b><?php _e('This option will Remove Featured Images that were created using an old version of this plugin. Featured images that you set manually, will not be changed.', 'appStoreAssistant' ); ?></b> <?php _e('You may need to run this process a few times depending on how many posts you have.', 'appStoreAssistant' ); ?></p>
<p><?php _e('You may also use this version to remove all Featured Images created with this plugin', 'appStoreAssistant' ); ?>.</p>
<p><?php _e('After removing the Featured Images, visit the', 'appStoreAssistant' ); ?> <a href="admin.php?page=appStore_sm_utilities&tab=defaultTab"><?php _e('Add Featured Images', 'appStoreAssistant' ); ?></a> <?php _e('tab to add the new format Featured Images to your posts', 'appStoreAssistant' ); ?>.</p>

<div class="asa_admin">
	<input type="checkbox" value="DoIt" name="appStore_options[ResetFIOne]" /> <?php _e('I want to remove all ASA set Featured Images.', 'appStoreAssistant' ); ?><br /><br />
	<input type="checkbox" value="DoIt" name="appStore_options[ResetFITwo]" /> <?php _e('I know this will slow down my site as it rebuilds.', 'appStoreAssistant' ); ?>
</div>