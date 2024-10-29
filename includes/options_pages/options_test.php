<h2 class="asa_admin">Test Options Page</h2>
<div class="asa_admin">
	
	<div class="asa_admin_element">Max Length of Short Description: <input type="text" size="4" name="appStore_options[max_description]" value="<?php echo $options['max_description']; ?>" maxlength="4" /> characters</div>
	<hr>



	<?php
$link_url = esc_url(wp_nonce_url( site_url('?my_page=ajax-processor&action=getcomment'), "my-theme_getcomment"));
?>
<a href='<?php echo $link_url; ?>' id='get-comments'><?php _e('Get Comments','get-comments'); ?></a>
<div id="get-comments-output"></div>




</div>