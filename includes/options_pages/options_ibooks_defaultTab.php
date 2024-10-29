<h2 class="asa_admin"><?php _e('Show in Post body', 'appStoreAssistant' ); ?></h2>
   	<div class="asa_admin">
  		<?php
    	$iBooksStoreProperties = array(
    		array('ID' => "displayibookstitle", 'label' => "Book Title"),
    		array('ID' => "displayibooksauthorname", 'label' => "Author Name"),
    		array('ID' => "displayibooksgenre", 'label' => "Genre"),
    		array('ID' => "displayibooksreleasedate", 'label' => "Publish Date"),
    		array('ID' => "displayibooksdescription", 'label' => "Description"),
    		array('ID' => "displayibooksexplicitwarning", 'label' => "Explicit Contents Bagde"),
    	);
		$hiddenlist = array();

		foreach($iBooksStoreProperties as $iBooksStoreProperty) {
			array_push($hiddenlist, $iBooksStoreProperty['ID']);
			echo '<input type="checkbox" name="appStore_options[';
			echo $iBooksStoreProperty['ID'];
			echo ']" value="yes"';
			if ($options[$iBooksStoreProperty['ID']] == "yes") echo ' checked';
			echo ' /> '.$iBooksStoreProperty['label']."<br />\r";
		}
		$hiddenlistcsv = implode(',', $hiddenlist);
		echo '<input type="hidden" name="appStore_options[checkboxedoptions]" value="'.$hiddenlistcsv.'" />'
		?>
		</div>
