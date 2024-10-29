<h2 class="asa_admin"><?php _e('Show in Post body', 'appStoreAssistant' ); ?></h2>
   	<div class="asa_admin">
  		<?php
    	$iTunesStoreProperties = array(
    		array('ID' => "displayitunestitle", 'label' => "Music Title"),
    		array('ID' => "displayitunestrackcount", 'label' => "Track Count"),
    		array('ID' => "displayitunestracklisting", 'label' => "Track Listing"),
    		array('ID' => "displayitunesartistname", 'label' => "Artist Name"),
    		array('ID' => "displayitunesfromalbum", 'label' => "From Album&hellip;"),
    		array('ID' => "displayitunesgenre", 'label' => "Genre"),
    		array('ID' => "displayitunesreleasedate", 'label' => "Release Date"),
    		array('ID' => "displayitunesdescription", 'label' => "Description"),
    		array('ID' => "displayitunesexplicitwarning", 'label' => "Explicit Lyrics Bagde"),
    	);
		$hiddenlist = array();

		foreach($iTunesStoreProperties as $iTunesStoreProperty) {
			array_push($hiddenlist, $iTunesStoreProperty['ID']);
			echo '<input type="checkbox" name="appStore_options[';
			echo $iTunesStoreProperty['ID'];
			echo ']" value="yes"';
			if ($options[$iTunesStoreProperty['ID']] == "yes") echo ' checked';
			echo ' /> '.$iTunesStoreProperty['label']."<br />\r";
		}
		$hiddenlistcsv = implode(',', $hiddenlist);
		echo '<input type="hidden" name="appStore_options[checkboxedoptions]" value="'.$hiddenlistcsv.'" />'
		?>
		</div>
