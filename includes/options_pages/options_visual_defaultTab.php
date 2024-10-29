<?php
    	$starColors = array("lt-blue","clear", "black", "blue","yellow","orange-yellow","gold","green","orange","pink","purple","red");
    	?>

    	<h2 class="asa_admin"><?php _e('Full Star', 'appStoreAssistant' ); ?></h2>
		<?php
    	foreach ($starColors as $starColor) {
    		echo '<input type="radio" ';
    		echo 'name="appStore_options[full_star_color]" ';
    		echo 'value="'.$starColor.'"';
    		if ($options['full_star_color'] == $starColor) echo ' checked';
    		echo ' />';
    		echo '<img src="';
    		echo plugins_url( 'images/rating/star-rating-'.$starColor.'.png', ASA_MAIN_FILE );
    		echo '" alt="'.$starColor.' Star" />';
    		echo '&nbsp;&nbsp;&nbsp;';    	
		}
		?>
		<h2 class="asa_admin"><?php _e('Empty Star', 'appStoreAssistant' ); ?></h2>
		<?php
    	foreach ($starColors as $starColor) {
    		echo '<input type="radio" ';
    		echo 'name="appStore_options[empty_star_color]" ';
    		echo 'value="'.$starColor.'-empty"';
    		if ($options['empty_star_color'] == $starColor."-empty") echo ' checked';
    		echo ' />';
    		echo '<img src="';
    		echo plugins_url( 'images/rating/star-rating-'.$starColor.'-empty.png', ASA_MAIN_FILE );
    		echo '" alt="'.$starColor.' Star" />';
    		echo '&nbsp;&nbsp;&nbsp;';    	
		}

    	?>

    	<h2 class="asa_admin"><?php _e('Full Rating iOS 7 style', 'appStoreAssistant' ); ?></h2>
		<?php
    	$starColors = array("dot-green","dot-orange","dot-blue", "dot-melon","dot-pink","dot-purple","dot-yellow");
    	foreach ($starColors as $starColor) {
    		echo '<input type="radio" ';
    		echo 'name="appStore_options[full_star_color]" ';
    		echo 'value="'.$starColor.'"';
    		if ($options['full_star_color'] == $starColor) echo ' checked';
    		echo ' />';
    		echo '<img src="';
    		echo plugins_url( 'images/rating/star-rating-'.$starColor.'.png', ASA_MAIN_FILE );
    		echo '" alt="'.$starColor.' Star" />';
    		echo '&nbsp;&nbsp;&nbsp;';    	
		}
		?>
		<h2 class="asa_admin"><?php _e('Empty Rating iOS 7 style', 'appStoreAssistant' ); ?></h2>
		<?php
    	foreach ($starColors as $starColor) {
    		echo '<input type="radio" ';
    		echo 'name="appStore_options[empty_star_color]" ';
    		echo 'value="'.$starColor.'-empty"';
    		if ($options['empty_star_color'] == $starColor."-empty") echo ' checked';
    		echo ' />';
    		echo '<img src="';
    		echo plugins_url( 'images/rating/star-rating-'.$starColor.'-empty.png', ASA_MAIN_FILE );
    		echo '" alt="'.$starColor.' Star" />';
    		echo '&nbsp;&nbsp;&nbsp;';    	
		}






?>
		
