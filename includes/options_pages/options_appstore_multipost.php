<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 25em; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script>

jQuery(function() {
	jQuery( "#sortable" ).sortable({
        stop : function(event, ui){
          //alert(jQuery(this).sortable('serialize'));
          var ordering = jQuery(this).sortable('toArray').toString();
          document.getElementById("app_elements_order").value = ordering;
          //alert(ordering);
        }
    });
	jQuery( "#sortable" ).disableSelection();
});
</script>
<h2 class="asa_admin">Show the following elements in each section of a page with Multiple Posts</h2>
<div class="asa_admin">
		<?php
    	$appStoreElements = array(
     		array('ID' => "-----", 'label' => __('Single Elements', 'appStoreAssistant' )),
     		array('ID' => "displaympapptitle", 'label' => __("App Name", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_NOTITLE,INLINE_NOTITLE"),
    		array('ID' => "displaympappicon", 'label' => __("App Icon", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_NOTITLE,INLINE_NOTITLE"),
     		array('ID' => "displaympappiconbuybutton", 'label' => __("App Icon w/ buy button", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_NOTITLE,INLINE_NOTITLE"),
			array('ID' => "displaympstarrating", 'label' => __("App Star Rating", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,INLINE_TITLE,INLINE_NOTITLE"),
			array('ID' => "displaympappdescription", 'label' => __("App Description", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,INLINE_TITLE,INLINE_NOTITLE,CLOSED,OPEN"),
    		array('ID' => "displaympappreleasenotes", 'label' => __("App Release Notes", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,INLINE_TITLE,INLINE_NOTITLE,CLOSED,OPEN"),
    		array('ID' => "displaympappdetailssection", 'label' => __("Details Section", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,CLOSED,OPEN"),
      		array('ID' => "displaympscreenshots", 'label' => __("Screen Shots", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,CLOSED,OPEN"),
      		array('ID' => "displaympsupporteddevices", 'label' => __("Supported Devices", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,INLINE_TITLE,INLINE_NOTITLE,CLOSED,OPEN"),
    		array('ID' => "displaympappbadge", 'label' => __("App Store Badge", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_NOTITLE,INLINE_NOTITLE"),
     		array('ID' => "displaympgamecenterenabled", 'label' => __("Game Center Enabled icon", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_TITLE,NORM_NOTITLE,INLINE_NOTITLE"),
    		array('ID' => "displaympappbuybutton", 'label' => __("App Buy Button", 'appStoreAssistant' ), 'modes' => "HIDE,NORM_NOTITLE,INLINE_NOTITLE"),
     		array('ID' => "-----", 'label' => __("Details Elements", 'appStoreAssistant' ), 'modes' => ""),
  	 		array('ID' => "displaympversion", 'label' => __("App Version", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
     		array('ID' => "displaympdevelopername", 'label' => __("Developer Name", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
    		array('ID' => "displaympsellername", 'label' => __("Seller Name", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
  			array('ID' => "displaympreleasedate", 'label' => __("Date Released", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
  			array('ID' => "displaympprice", 'label' => __("Price", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
     		array('ID' => "displaympfilesize", 'label' => __("File Size", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
     		array('ID' => "displaympuniversal", 'label' => __("Universal App icon", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_NOTITLE"),
 			array('ID' => "displaympadvisoryrating", 'label' => __("Advisory Rating", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
 			array('ID' => "displaympappinapppurwarning", 'label' => __("Offers In-App Purchases", 'appStoreAssistant' ).'*', 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE"),
   			array('ID' => "displaympcategories", 'label' => __("App Categories", 'appStoreAssistant' ), 'modes' => "HIDE,INLINE_TITLE,INLINE_NOTITLE")
    	);  	
 		echo '<div class="appStore_datagrid">';
		echo '<table><thead><tr><th>Element</th><th>Mode</th></tr></thead><tbody>';
		foreach($appStoreElements as $appStoreElement) {
			if($appStoreElement['ID'] == "-----") {
				echo '<tr class="alt"><td colspan="2">';
				echo "- ".$appStoreElement['label']." -";
				echo '</tr>';
			} else {
				echo "<tr>\r";
				echo '<td style="text-align:right"><b>'.$appStoreElement['label'].'</b></td>';
				echo '<td style="text-align:right">';
				echo '<select name="appStore_options[';
				echo $appStoreElement['ID'];
				echo ']">';
				$AllowedModes = explode(",", $appStoreElement['modes']);
				if(in_array("HIDE", $AllowedModes)) {
					echo '<option value="HIDE" ';
					if ($options[$appStoreElement['ID']] == "HIDE" || $options[$appStoreElement['ID']] == "no") echo 'selected';
					echo '>Hide Element</option>';
				}
				if(in_array("NORM_TITLE", $AllowedModes)) {
					echo '<option value="NORM_TITLE" ';
					if ($options[$appStoreElement['ID']] == "NORM_TITLE" || $options[$appStoreElement['ID']] == "yes") echo 'selected';
					echo '>Normal</option>';
				}
				if(in_array("NORM_NOTITLE", $AllowedModes)) {
					echo '<option value="NORM_NOTITLE" ';
					if ($options[$appStoreElement['ID']] == "NORM_NOTITLE" || $options[$appStoreElement['ID']] == "notitle" || $options[$appStoreElement['ID']] == "yes") echo 'selected';
					echo '>Normal No Title</option>';
				}
				if(in_array("INLINE_TITLE", $AllowedModes)) {
					echo '<option value="INLINE_TITLE" ';
					if ($options[$appStoreElement['ID']] == "INLINE_TITLE") echo 'selected';
					echo '>Inline</option>';
				}
				if(in_array("INLINE_NOTITLE", $AllowedModes)) {
					echo '<option value="INLINE_NOTITLE" ';
					if ($options[$appStoreElement['ID']] == "INLINE_NOTITLE") echo 'selected';
					echo '>Inline No Title</option>';
				}
				if(in_array("CLOSED", $AllowedModes)) {
					echo '<option value="CLOSED" ';
					if ($options[$appStoreElement['ID']] == "CLOSED" || $options[$appStoreElement['ID']] == "closed") echo 'selected';
					echo '>Accordion Closed</option>';
				}
				if(in_array("OPEN", $AllowedModes)) {
					echo '<option value="OPEN" ';
					if ($options[$appStoreElement['ID']] == "OPEN" || $options[$appStoreElement['ID']] == "open") echo 'selected';
					echo '>Accordion Open</option>';
				}
				echo "</select></td></tr>\r";
			}
		}
		

		echo '</tbody></table></div>';
		
		?>
		
<b><?php _e('Hide Element', 'appStoreAssistant' ); ?></b>: <?php _e('Do Not Display this element', 'appStoreAssistant' ); ?><br />
<b><?php _e('Normal', 'appStoreAssistant' ); ?></b>: <?php _e('Display Element Title in H3 tag and Separate Element', 'appStoreAssistant' ); ?><br />
<b><?php _e('Normal No Title', 'appStoreAssistant' ); ?></b>: <?php _e('Same as Normal except the title is omitted. (Handy for themes that remove formatting)', 'appStoreAssistant' ); ?><br />
<b><?php _e('Inline', 'appStoreAssistant' ); ?></b>: <?php _e('Displays Section Title: Description (No new line or Header tag)', 'appStoreAssistant' ); ?><br />
<b><?php _e('Inline No Title', 'appStoreAssistant' ); ?></b>: <?php _e('Same as Inline except the title is omitted', 'appStoreAssistant' ); ?><br />
<b><?php _e('Accordion Closed', 'appStoreAssistant' ); ?></b>: <?php _e('Show the element in an Accordion (starting off closed)', 'appStoreAssistant' ); ?><br />
<b><?php _e('Accordion Open', 'appStoreAssistant' ); ?></b>: <?php _e('Show the element in an Accordion (starting off open)', 'appStoreAssistant' ); ?><br />
<hr>
<b>*</b>Displays this warning when available.<br />
	
</div>
<?php
    	$appStoreProperties = array(
    		"appStoreDetail_appName" => __("App Name", 'appStoreAssistant' ),
    		"appStoreDetail_appIcon" => __("App Icon", 'appStoreAssistant' ),
    		"appStoreDetail_appIconBuyButton" => __("App Icon w/ Buy Button", 'appStoreAssistant' ),
    		"appStoreDetail_appDescription" => __("App Description", 'appStoreAssistant' ),
    		"appStoreDetail_appReleaseNotes" => __("App ReleaseNotes", 'appStoreAssistant' ),
    		"appStoreDetail_appBadge" => __("App Store Badge", 'appStoreAssistant' ),
    		"appStoreDetail_appDetails" => __("App Details", 'appStoreAssistant' ),
    		"appStoreDetail_appRating" => __("App Star Rating", 'appStoreAssistant' ),
    		"appStoreDetail_appScreenshots" => __("Screen Shots", 'appStoreAssistant' ),
    		"appStoreDetail_appGCIcon" => __("Game Center Enabled icon", 'appStoreAssistant' ),
    		"appStoreDetail_appDeviceList" => __("Supported Devices List", 'appStoreAssistant' ),
   			"appStoreDetail_appBuyButton" => __("App Buy Button", 'appStoreAssistant' )
   			);

		$appDetailsOrder = explode(",", appStore_setting('appMPDetailsOrder'));
		$appDetailsOrder = array_filter($appDetailsOrder, 'strlen');
		
		if(count($appDetailsOrder) != 12) {
			//echo "-----".count($appDetailsOrder)."------[<pre>".print_r($appDetailsOrder,true)."</pre>]-------------";
			$appElements_DefaultList = "appStoreDetail_appName,appStoreDetail_appIcon,appStoreDetail_appDescription,appStoreDetail_appReleaseNotes,appStoreDetail_appBadge,appStoreDetail_appDetails,appStoreDetail_appGCIcon,appStoreDetail_appScreenshots,appStoreDetail_appDeviceList,appStoreDetail_appBuyButton,appStoreDetail_appRating,appStoreDetail_appIconBuyButton";
			$appDetailsOrder = explode(",",$appElements_DefaultList);
			$appDetailsOrder = array_filter($appDetailsOrder, 'strlen');
			//echo "-----".count($appDetailsOrder)."------[<pre>".print_r($appDetailsOrder,true)."</pre>]-------------";
			$appElements_StartList = $appElements_DefaultList;
		} else {
		
			$appElements_StartList = appStore_setting('appMPDetailsOrder');
		}
?>		
		
		
<h2 class="asa_admin"><?php _e('Order of Elements', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<?php _e('Drag the elements into the order you would like them displayed', 'appStoreAssistant' ); ?><br />
<ul id="sortable">
<?php

	foreach($appDetailsOrder as $appDetailOrder) {
		echo '<li id="';
		echo $appDetailOrder;
		echo '" class="ui-state-default">';
		echo '<img src="'.plugins_url( 'images/adminDetails/'.$appDetailOrder, ASA_MAIN_FILE ) .'.png" alt="'.$appDetailOrder.'" align="middle" /> ';
		echo ' &nbsp;&nbsp;&nbsp;'.$appStoreProperties[$appDetailOrder]."</li>\r";
	}
?>
</ul>
<input type="hidden" id="app_elements_order" name="appStore_options[appMPDetailsOrder]" value="<?php echo $appElements_StartList; ?>" />
<div style="clear:both;"></div>
</div>
