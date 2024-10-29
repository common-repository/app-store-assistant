<h2>Item IDs</h2>
<h3 class="asa_admin"><?php _e('iOS App ID', 'appStoreAssistant' ); ?>:</h3>
<i>https://itunes.apple.com/us/app/1password/id<b>568903335</b>?mt=8</i><br />
<?php _e('Works with iOS Apps or Apple TV Apps', 'appStoreAssistant' ); ?>
<h3 class="asa_admin"><?php _e('iTunes Item', 'appStoreAssistant' ); ?>:</h3>
<i>https://itunes.apple.com/us/album/aliens-original-motion-picture/id<b>62101268</b></i><br />
<?php _e('Works with Songs, Albums, Movies, Short Films, TV Episodes, Seasons, AudioBooks, eBooks and Music Videos', 'appStoreAssistant' ); ?>
<h3 class="asa_admin"><?php _e('Mac App ID', 'appStoreAssistant' ); ?>:</h3>
<i>https://itunes.apple.com/us/app/1password-password-manager/id<b>443987910</b>?mt=12</i><br />
<?php _e('Works with Mac Apps', 'appStoreAssistant' ); ?>
<h3 class="asa_admin">Amazon.com ASIN:</h3>
The Amazon Standard Identification Number <?php _e('is a 10-character alphanumeric unique identifier assigned by Amazon.com<p>Found in the URL from', 'appStoreAssistant' ); ?> Amazon.com<br /><?php _e('For example', 'appStoreAssistant' ); ?>: <i>http://www.amazon.com/dp/<b>B001KNH8VU</b>/?tag=047-20</i></p>

<hr>
<h2><?php _e('Shortcodes', 'appStoreAssistant' ); ?></h2>

<h3 class="asa_admin"><?php _e('Display a single item', 'appStoreAssistant' ); ?>:</h3>

<div class="asa_help">
<ul>
<li>[asa_item id="568903335" more_info_text="More Info on this App..."]<p><?php _e('Displays a single Mac/iOS app or iTunes item', 'appStoreAssistant' ); ?></p>
	<ul>
	<li>id: <?php _e('The Items Store ID', 'appStoreAssistant' ); ?></li>
	<li>more_info_text: <?php _e('Excerpt "more info" link text (optional)', 'appStoreAssistant' ); ?></li>
	</ul>
</li>
<li>[amazon_item asin="B001KNH8VU" more_info_text="More Info on this item from Amazon.com..."]<p><?php _e('Displays a single item from', 'appStoreAssistant' ); ?> Amazon.com</p>
	<ul>
	<li>asin: The Amazon Standard Identification Number</li>
	<li>more_info_text: <?php _e('Excerpt "more info" link text (optional)', 'appStoreAssistant' ); ?></li>
	</ul>
</li>
<li>[asa_item link="https://itunes.apple.com/us/app/1password/id568903335?mt=8" more_info_text="More Info on this App..."]<p><?php _e('Displays a single Mac/iOS app or iTunes item using a link', 'appStoreAssistant' ); ?>*</p>
	<ul>
	<li>link: <?php _e('The items full URL', 'appStoreAssistant' ); ?></li>
	<li>more_info_text: <?php _e('Excerpt "more info" link text (optional)', 'appStoreAssistant' ); ?></li>
	</ul>
</li>
*(<?php _e('You will still need to run the Add Featured Images Function, if you want the Featured Image.', 'appStoreAssistant' ); ?>)<br /><br />
</ul>


<h3 class="asa_admin"><?php _e('Display several items from a ATOM/RSS Feed', 'appStoreAssistant' ); ?>:</h3>
	
<ul>
<li>[asaf_atomfeed atomurl="http://iTunes.apple.com/us/rss/toppaidmacapps/limit=25" more_info_text="open in App Store..."]<p><?php _e('Displays the items from the ATOM feed in a formatted view', 'appStoreAssistant' ); ?></p>
	<ul>
	<li>atomurl: feed URL supplied by Apple RSS Generator<p><?php _e('These feeds can be generated here', 'appStoreAssistant' ); ?>: <i>https://rss.itunes.apple.com/</i>.</p></li>
	<li>more_info_text: <?php _e('Excerpt "more info" link text (optional)', 'appStoreAssistant' ); ?></li>
	</ul>
</li>
</ul>


<h3 class="asa_admin"><?php _e('Display several items from a list of IDs', 'appStoreAssistant' ); ?>:</h3>
	
<ul>

<li>[asa_list ids="568903335,62101268,443987910,568903335" more_info_text="open in Store..."]<p><?php _e('Displays Several apps or iTunes items on a single page or post', 'appStoreAssistant' ); ?></p>
	<ul>
	<li>ids: <?php _e("Comma separated list Mac App, iOS App's or iTunes IDs", 'appStoreAssistant' ); ?></li>
	<li>more_info_text: <?php _e('Button text', 'appStoreAssistant' ); ?></li>
	</ul>
</li>
</ul>

<h3 class="asa_admin"><?php _e('Display just a html link to an item', 'appStoreAssistant' ); ?>:</h3>

<ul>
	<li>[asa_link id="568903335" text="App Name"]<p><?php _e('Displays a text only link to the App or iTunes item', 'appStoreAssistant' ); ?></p>
	<ul>
	<li>id: <?php _e("The app or items's ID", 'appStoreAssistant' ); ?></li>
	</ul>
</li>
<li>[amazon_item_link asin="B005F02DA0" linktext="Star Wars Ep. 7" textmode="linktext" mode="text" showprice="yes"]<p><?php _e('Displays the link as a button or text with the Link Text to the Amazon Item', 'appStoreAssistant' ); ?></p>
	<ul>
	<li>asin: The Amazon Standard Identification Number</li>
	<li>linktext: <?php _e('Link text (optional)', 'appStoreAssistant' ); ?><p><?php _e('This will be used for the link if', 'appStoreAssistant' ); ?> textmode=linktext</p></li>
	<li>showprice: (optional)<p><?php _e('If this is set to yes, the price will be shown after the link text', 'appStoreAssistant' ); ?></p></li>
	<li>textmode: [<b>linktext</b>, itemname, defaulttext]
		<p>
		<b>linktext</b> <?php _e('displays the text specified in', 'appStoreAssistant' ); ?> linktext<br />
		<b>defaulttext</b> <?php _e('displays the text specified in', 'appStoreAssistant' ); ?> Amazon.com <?php _e('settings', 'appStoreAssistant' ); ?><br />
		<b>itemname</b> <?php _e('displays the item name', 'appStoreAssistant' ); ?>
		</p>
	</li>
	<li>mode: [<b>text</b>, button or both]
		<p>
		<b>text</b> <?php _e('displays a text link', 'appStoreAssistant' ); ?><br />
		<b>button</b> <?php _e('displays graphical button for the link', 'appStoreAssistant' ); ?><br />
		<b>both</b> <?php _e('displays both text and a button', 'appStoreAssistant' ); ?>.<br />
		</p>
	</li>
	</ul>
</li>
</ul>

<h3 class="asa_admin"><?php _e('Display elements from an item', 'appStoreAssistant' ); ?>:</h3>

<ul>
	<li>[asa_elements id="568903335" elements="appName"]<p><?php _e('Displays the element or elements for the iOS or Mac App', 'appStoreAssistant' ); ?></p>
	<ul>
	<li>id: <?php _e("The iOS,  Mac app or iTunes item's ID", 'appStoreAssistant' ); ?></li>
	<li>elements: <?php _e('One or more of the following items', 'appStoreAssistant' ); ?>:<br />
	
<ul>
<li>appName</li>
<li>appIcon</li>
<li>appDescription</li>
<li>appReleaseNotes</li>
<li>appBadge</li>
<li>appDetails</li>
<li>appGCIcon</li>
<li>appScreenshots</li>
<li>appDeviceList</li>
<li>appBuyButton</li>
<li>appRating</li>
<li>appPrice</li>
</ul>
	
	</p></li>
	</ul>
</li>
</ul></div>
<?php
$showSaveChangesButton = false;
?>
