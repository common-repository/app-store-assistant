<p><?php _e("TradeDoubler offers the iTunes and App Store Affiliate Program as separate programs in 14 different countries. You need to be accepted into at least one country to be able to link in Europe. If you need to link to several EU countries for which you don't yet have an affiliate account, you can enable this directly on the TradeDoubler portal", 'appStoreAssistant' ); ?> (<?php _e('Settings', 'appStoreAssistant' ); ?> -> <?php _e('Site Information', 'appStoreAssistant' ); ?> -> <?php _e('My Countries', 'appStoreAssistant' ); ?>).</p>

<p><?php _e('To create an affiliate tracking link for TradeDoubler (Europe), you will need your program ID and website ID. These can be found on the TradeDoubler affiliate dashboard (Under "Settings" then "Site information")', 'appStoreAssistant' ); ?>.</p>

TradeDoubler websiteID: <input type="text" size="20" name="appStore_options[tdwebsiteID]" value="<?php echo $options['tdwebsiteID']; ?>"/><br />

TradeDoubler Program ID: <select name="appStore_options[tdprogramID]">
	<option value="24380" <?php if ($options['tdprogramID'] == "24380") echo 'selected'; ?>>iTunes AT</option>
	<option value="24379" <?php if ($options['tdprogramID'] == "24379") echo 'selected'; ?>>iTunes BE</option>
	<option value="24372" <?php if ($options['tdprogramID'] == "24372") echo 'selected'; ?>>iTunes CH</option>
	<option value="23761" <?php if ($options['tdprogramID'] == "23761") echo 'selected'; ?>>iTunes DE</option>
	<option value="24375" <?php if ($options['tdprogramID'] == "24375") echo 'selected'; ?>>iTunes DK</option>
	<option value="24364" <?php if ($options['tdprogramID'] == "24364") echo 'selected'; ?>>iTunes ES</option>
	<option value="24366" <?php if ($options['tdprogramID'] == "24366") echo 'selected'; ?>>iTunes FI</option>
	<option value="23753" <?php if ($options['tdprogramID'] == "23753") echo 'selected'; ?>>iTunes FR</option>
	<option value="23708" <?php if ($options['tdprogramID'] == "23708") echo 'selected'; ?>>iTunes GB</option>
	<option value="24367" <?php if ($options['tdprogramID'] == "24367") echo 'selected'; ?>>iTunes IE</option>
	<option value="24373" <?php if ($options['tdprogramID'] == "24373") echo 'selected'; ?>>iTunes IT</option>
	<option value="24371" <?php if ($options['tdprogramID'] == "24371") echo 'selected'; ?>>iTunes NL</option>
	<option value="24369" <?php if ($options['tdprogramID'] == "24369") echo 'selected'; ?>>iTunes NO</option>
	<option value="23762" <?php if ($options['tdprogramID'] == "23762") echo 'selected'; ?>>iTunes SE</option>
	</select>
