<p><?php _e('You can apply to the program here', 'appStoreAssistant' ); ?>: <a href="http://affiliate.itunes.apple.com/apply">PHG</a></p>

PHG Affiliate ID: <input type="text" size="10" name="appStore_options[PHGaffiliateID]" value="<?php echo $options['PHGaffiliateID']; ?>" maxlength="15" /><br />

<h4><?php _e('Campaign Values', 'appStoreAssistant' ); ?></h4>

<p><?php _e('The Campaign Value is campaign text that you can optionally add to any link in order to track sales from a specific marketing campaign. By using a campaign value, you will see in the reporting dashboard all clicks and sales related to that specific campaign.', 'appStoreAssistant' ); ?></p>

<p><?php _e('You can name the campaigns anything you choose, but the Campaign Value may not be longer than 45 characters', 'appStoreAssistant' ); ?>:</p>




PHG Campaign Value: <input type="text" size="11" name="appStore_options[phgCampaignvalue]" value="<?php echo $options['phgCampaignvalue']; ?>" maxlength="45" />
