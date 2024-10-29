<?php
define('DEBUG', false);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


//hash_hmac code from comment by Ulrich in http://mierendo.com/software/aws_signed_query/
//sha256.inc.php from http://www.nanolink.ca/pub/sha256/ 

function appStore_amazon_link_handler ($atts,$content=null, $code="") {
	// Get App ID and more_info_text from shortcode
	extract( shortcode_atts( array(
		'asin' => '',
		'mode' => '',
		'textmode' => '',
		'showprice' => '',
		'linktext' => ''
	), $atts ) );

	//Don't do anything if the ASIN is blank or non-numeric
	if ($asin=='') return;
	
	$AmazonProductData = appStore_get_amazonData($asin);
	if($AmazonProductData) {
		$itemURLStart = '<a href="'.$AmazonProductData['URL'].'" target="_blank">';
		$itemTitle = $AmazonProductData['Title'];
		$itemPrice = $AmazonProductData['Amount'];
		
		// Get Default Text Link
		if($showprice=="yes") {		
			if($itemPrice == "Not Listed") {
				$itemLinkText = appStore_setting('amazon_textlink_default');
			} else {
				$itemLinkText = appStore_setting('amazon_textlink_price_default');
			}
		} else {
			$itemLinkText = appStore_setting('amazon_textlink_default');
		}

		// Check Text Mode
		switch ($textmode) {
			case "linktext":
				if(isset($linktext)) $itemLinkText = $linktext;	
				break;
			case "defaulttext":
				// Other options could go here	
				break;
			case "itemname":
				if(isset($itemTitle)) $itemLinkText = $itemTitle;	
				break;
		}

		if($showprice=="yes") $itemLinkText .= " $itemPrice";

		// Set Button Image
		$itemButtonImage = '<img src="'.plugins_url( 'images/amazon-buynow-button.png' , ASA_MAIN_FILE ).'" width="220" height="37" alt="'.$asin.'" />';

		switch ($mode) {
			case "text":
				$itemLink = $itemURLStart.$itemLinkText.'</a>';	
				break;
			case "button":
				$itemLink = $itemURLStart.$itemButtonImage.'</a>';	
				break;
			case "both":
				$itemLink = $itemURLStart.$itemLinkText.'</a><br /><br />'.$itemURLStart.$itemButtonImage.'</a><br /><br />';	
				break;
			default:
				$itemLink = $itemURLStart.$itemLinkText.'</a>';	
		}
	} else {
		$itemLink = "ERROR LOADING AMAZON.COM DATA (Check Settings)";
	}
	return $itemLink;
}

function appStore_handler_amazon_raw ( $atts,$content=null, $code="" ) {
	// Get App ID and more_info_text from shortcode
	extract( shortcode_atts( array('asin' => ''	), $atts ) );

	//Don't do anything if the ASIN is blank or non-numeric
	if ($asin=='') return;
	$appStore_options_data = appStore_page_get_amazonXML($asin);
	$output = '<div class="debug">';
	$output .= "RAW DATA FOR $asin <br />";
	$output .= '<pre>';
	$output .= print_r($appStore_options_data,true);
	$output .= '</pre>';
	$output .= '</div>';
	return $output;
}

function appStore_amazon_handler( $atts,$content=null, $code="") {
	// Get App ID and more_info_text from shortcode
	extract( shortcode_atts( array(
		'asin' => '',
		'text' => ''
	), $atts ) );

	//Don't do anything if the ASIN is blank or non-numeric
	if ($asin=='') return;
	
	
	$AmazonProductData = appStore_get_amazonData($asin);	
	$amazonDisplayData = appStore_displayAmazonItem($AmazonProductData);
	return $amazonDisplayData;
}	
	
function appStore_get_amazonData($asin) {
	//Check to see if we have a cached version of the Amazon Product Data.
	$appStore_options = get_option('appStore_amazonData_' . $asin, 'NODATA');		
	//$appStore_options = 'NODATA'; //SEALDEBUG - ALWAYS REFRESH
	
	$nextCheck = (isset($appStore_options['next_check']) ? $appStore_options['next_check'] : '');
	if($appStore_options == 'NODATA' || $nextCheck < time()) {
		$appStore_options_data = appStore_page_get_amazonXML($asin);

		if(isset($appStore_options_data['Error'])) {
			$nextCheck = 10;
		} else {
			$nextCheck = time() + appStore_setting('cache_time_select_box');
			if(appStore_setting('cache_images_locally') == '1') {
				$appStore_options_data = appStore_save_amazonImages_locally($appStore_options_data);
			}
		}		
		
		$appStore_options = array('next_check' => $nextCheck, 'app_data' => $appStore_options_data);
		update_option('appStore_amazonData_' . $asin, $appStore_options);
		
	}
	return $appStore_options['app_data'];
}

function appStore_getBestAmazonImage($asin) {
	$filename = false;
	$firstChoice = CACHE_DIRECTORY."Amazon/".$asin."/LargeImage.png";
	$secondChoice = CACHE_DIRECTORY."Amazon/".$asin."/LargeImage.jpg";
	$thirdChoice = CACHE_DIRECTORY."Amazon/".$asin."/MediumImage.png";
	$fourthChoice = CACHE_DIRECTORY."Amazon/".$asin."/MediumImage.jpg";
	$fifthChoice = CACHE_DIRECTORY."Amazon/".$asin."/SmallImage.png";
	$sixthChoice = CACHE_DIRECTORY."Amazon/".$asin."/SmallImage.jpg";
	$lastChoice = dirname( plugin_basename( __FILE__ ) )."/images/CautionIcon.png";

	if (file_exists($firstChoice)) {
		$filename = $firstChoice;
	} elseif(file_exists($secondChoice)) {
		$filename = $secondChoice;
	} elseif(file_exists($thirdChoice)) {
		$filename = $thirdChoice;
	} elseif(file_exists($fourthChoice)) {
		$filename = $fourthChoice;
	} elseif(file_exists($fifthChoice)) {
		$filename = $fifthChoice;
	} elseif(file_exists($sixthChoice)) {
		$filename = $sixthChoice;
	} elseif(file_exists($lastChoice)) {
		$filename = $lastChoice;
	}
	return $filename;
}

function appStore_save_amazonImages_locally($productData) {
	$asin = $productData['ASIN'];	

	//Save Non-Cached Images incase of problem
	$productData['SmallImage_cached'] = $productData['SmallImage'];
	$productData['MediumImage_cached'] = $productData['MediumImage'];
	$productData['LargeImage_cached'] = $productData['LargeImage'];	
	
	if($productData['SmallImage']) $bestImage = $productData['SmallImage'];
	if($productData['MediumImage']) $bestImage = $productData['MediumImage'];
	if($productData['LargeImage']) $bestImage = $productData['LargeImage'];
	$productData['imageFeatured'] = $bestImage;
	$productData['imageFeatured_cached'] = $bestImage;
	$productData['imageiOS'] = $bestImage;
	$productData['imageiOS_cached'] = $bestImage;
	$productData['imageWidget'] = $bestImage;
	$productData['imageWidget_cached'] = $bestImage;
	$productData['imageRSS'] = $bestImage;
	$productData['imageRSS_cached'] = $bestImage;
	$productData['imageLists'] = $bestImage;
	$productData['imageLists_cached'] = $bestImage;
	$productData['imagePosts'] = $bestImage;
	$productData['imagePosts_cached'] = $bestImage;
	$productData['imageElements'] = $bestImage;
	$productData['imageElements_cached'] = $bestImage;

	if(!is_writeable(CACHE_DIRECTORY)) {
		//Uploads dir isn't writeable. bummer.
		appStore_set_setting('cache_images_locally', '0');
		return;
	} else {
		if(!is_dir(CACHE_DIRECTORY ."Amazon/". $asin)) {
			if(!mkdir(CACHE_DIRECTORY ."Amazon/". $asin, 0755, true)) {
				appStore_set_setting('cache_images_locally', '0');
				return;	
			}
		}
		$urls_to_cache = array();
		if($productData['SmallImage']) $urls_to_cache['SmallImage'] = $productData['SmallImage'];
		if($productData['MediumImage']) $urls_to_cache['MediumImage'] = $productData['MediumImage'];
		if($productData['LargeImage']) $urls_to_cache['LargeImage'] = $productData['LargeImage'];

		foreach($urls_to_cache as $urlname=>$url) {
			$content = appStore_fopen_or_curl($url);
			$info = pathinfo(basename($url));
			$Newpath = CACHE_DIRECTORY ."Amazon/". $asin . '/' . $urlname.".".$info['extension'];
			$Newurl = CACHE_DIRECTORY_URL ."Amazon/". $asin . '/' . $urlname.".".$info['extension'];
			
			if($fp = fopen($Newpath, "w+")) {
				fwrite($fp, $content);
				fclose($fp);
				$productData[$urlname] = $Newurl;
			} else {
				//Couldnt write the file. Permissions must be wrong.
				appStore_set_setting('cache_images_locally', '0');
				return;
			}
		}
		$bestFilePath = appStore_getBestAmazonImage($asin);
		$bestFilePathParts = pathinfo($bestFilePath);
		$bestFileName = $bestFilePathParts['filename'];
		$bestFileExt = $bestFilePathParts['extension'];
				
		$productData['error'] = true;
		$productData['errormessage'] = $bestFilePath;
		return $productData;
			
		//Check to see if image exists
		if (is_writable ( $bestFilePath )) {
			$x = 1;	
		}
				
		$editor = wp_get_image_editor( $bestFilePath );
 		$size = $editor->get_size();
 		$filePrefix = "asaArtwork_";
		$filePath_Start = CACHE_DIRECTORY."Amazon/". $asin . '/'.$filePrefix;
		$fileURL_Start = CACHE_DIRECTORY_URL."Amazon/". $asin . '/'.$filePrefix;

 		if(appStore_setting('appicon_size_featured_w') < $size['width'] || appStore_setting('appicon_size_featured_h') < $size['height']) {
 			$newSize_w = appStore_setting('appicon_size_featured_w');
 			$newSize_h = appStore_setting('appicon_size_featured_h');
 			$newSize_c = (appStore_setting('appicon_size_featured_c') ? true : false);
			$editor->resize( $newSize_w, $newSize_h, $newSize_c  );
		}
		$filename = $filePath_Start."featured.".$bestFileExt;
		$new_image_info = $editor->save($filename);
		$productData['imageFeatured_cached'] = $fileURL_Start."featured.".$bestFileExt;
		$productData['imageFeatured_path'] = $filePath_Start."featured.".$bestFileExt;

		$editor = wp_get_image_editor( $bestFilePath );
 		if(appStore_setting('appicon_size_ios_w') < $size['width'] || appStore_setting('appicon_size_ios_h') < $size['height']) {
 			$newSize_w = appStore_setting('appicon_size_ios_w');
 			$newSize_h = appStore_setting('appicon_size_ios_h');
 			$newSize_c = (appStore_setting('appicon_size_ios_c') ? true : false);
			$editor->resize( $newSize_w, $newSize_h, $newSize_c  );
		}
		$filename = $filePath_Start."ios.".$bestFileExt;
		$new_image_info = $editor->save($filename);		
		$productData['imageiOS_cached'] = $fileURL_Start."featured.".$bestFileExt;

		$editor = wp_get_image_editor( $bestFilePath );
 		if(appStore_setting('appicon_size_rss_w') < $size['width'] || appStore_setting('appicon_size_rss_h') < $size['height']) {
 			$newSize_w = appStore_setting('appicon_size_rss_w');
 			$newSize_h = appStore_setting('appicon_size_rss_h');
 			$newSize_c = (appStore_setting('appicon_size_rss_c') ? true : false);
			$editor->resize( $newSize_w, $newSize_h, $newSize_c  );
		}
		$filename = $filePath_Start."rss.".$bestFileExt;
		$new_image_info = $editor->save($filename);		
		$productData['imageRSS_cached'] = $fileURL_Start."featured.".$bestFileExt;
			
		$editor = wp_get_image_editor( $bestFilePath );
 		if(appStore_setting('appicon_size_lists_w') < $size['width'] || appStore_setting('appicon_size_lists_h') < $size['height']) {
 			$newSize_w = appStore_setting('appicon_size_lists_w');
 			$newSize_h = appStore_setting('appicon_size_lists_h');
 			$newSize_c = (appStore_setting('appicon_size_lists_c') ? true : false);
			$editor->resize( $newSize_w, $newSize_h, $newSize_c  );
		}
		$filename = $filePath_Start."list.".$bestFileExt;
		$new_image_info = $editor->save($filename);		
		$productData['imageLists_cached'] = $fileURL_Start."featured.".$bestFileExt;

		$editor = wp_get_image_editor( $bestFilePath );
 		if(appStore_setting('appicon_size_posts_w') < $size['width'] || appStore_setting('appicon_size_posts_h') < $size['height']) {
 			$newSize_w = appStore_setting('appicon_size_posts_w');
 			$newSize_h = appStore_setting('appicon_size_posts_h');
 			$newSize_c = (appStore_setting('appicon_size_posts_c') ? true : false);
			$editor->resize( $newSize_w, $newSize_h, $newSize_c  );
		}
		$filename = $filePath_Start."post.".$bestFileExt;
		$new_image_info = $editor->save($filename);		
		$productData['imagePosts_cached'] = $fileURL_Start."featured.".$bestFileExt;

		$editor = wp_get_image_editor( $bestFilePath );
 		if(appStore_setting('appicon_size_element_w') < $size['width'] || appStore_setting('appicon_size_element_h') < $size['height']) {
 			$newSize_w = appStore_setting('appicon_size_element_w');
 			$newSize_h = appStore_setting('appicon_size_element_h');
 			$newSize_c = (appStore_setting('appicon_size_element_c') ? true : false);
			$editor->resize( $newSize_w, $newSize_h, $newSize_c  );
		}
		$filename = $filePath_Start."element.".$bestFileExt;
		$new_image_info = $editor->save($filename);		
		$productData['imageElements_cached'] = $fileURL_Start."featured.".$bestFileExt;

	}
	return $productData;
}

function appStore_page_get_amazonXML($asin) {
	//Check to see if AWS Info is filled out in Admin Section
	if(appStore_setting('AWS_API_KEY') == "" || appStore_setting('AWS_API_SECRET_KEY') == "" || appStore_setting('AWS_PARTNER_DOMAIN') == "") {
		$AmazonProductData['asin'] = $asin;
		$AmazonProductData['Description'] = "Error Processing Amazon Item, please check admin settings via the Amazon.com tab.";
		$errorImage = plugins_url( 'images/CautionIcon.png' , ASA_MAIN_FILE );
		$AmazonProductData['SmallImage'] = $errorImage;
		$AmazonProductData['MediumImage'] = $errorImage;
		$AmazonProductData['LargeImage'] = $errorImage;
		$AmazonProductData['Title'] = "Error Message";
		$AmazonProductData['Error'] = "NoKeys";
		return $AmazonProductData;
	}

	$aws_public_api_key = appStore_setting('AWS_API_KEY');
	$aws_secret_api_key = appStore_setting('AWS_API_SECRET_KEY');
	$aws_partner_domain = appStore_setting('AWS_PARTNER_DOMAIN');

	if(appStore_setting('AWS_ASSOCIATE_TAG') == "") {
		$aws_associate_id = "thewebbedseal";
	}else{
		$aws_associate_id = appStore_setting('AWS_ASSOCIATE_TAG');
	}

	$apaapi_errors			= '';
	$apaapi_responsegroup 	= "ItemAttributes,Images,Offers,Reviews,EditorialReview,Tracks";
	$apaapi_operation 		= "ItemLookup";
	$apaapi_idtype	 		= "ASIN";
	$apaapi_id				= $asin;
	
	$aws_region="us-east-1";
	$pxml = asa_amazon_api5_request($apaapi_id,$aws_region,$aws_public_api_key,$aws_secret_api_key,$aws_associate_id);
	
	//Check if responce is not an array and treat it like an error from Amazon.com
	if(!is_array($pxml)){
		$pxml_temp=$pxml;
		$pxml = array();
		$pxml['Errors'] = $pxml_temp;
	}

	//Check for errors from Amazon.com
	if(is_array($pxml)) {
		if(isset($pxml['Errors'])) {
			echo "Error processing Amazon.com lookup:<br />";
			if(is_array($pxml['Errors'])) {
				foreach ($pxml['Errors'] as $error) {
					echo $error['Message']."<br />";
				}
			} else {
				echo $pxml['Errors'];
			}
			exit;
		}
	}
	$AmazonProductData = asa_clean_amazon_results($pxml);

	return $AmazonProductData;

}

function appStore_displayAmazonItem($Data){
	$displayAmazonItem = "<!-- Default Listing -->";	

	//$displayAmazonItem .= '-------SEALDEBUG--------'.print_r($Data,true).'---------------';//Debug
	$displayAmazonItem .= '<div class="appStore-wrapper"><hr>';
	$displayAmazonItem .= '	<div id="amazonStore-icon-container">';
	
	//$displayAmazonItem .= $Data['Debug'];
	
	if(appStore_setting('cache_images_locally') == '1') {
		$imageTag = $Data['imagePosts_cached'];
	} else {
		$imageTag = $Data['imagePosts'];
	}	
	
	$displayAmazonItem .= '    <a href="'.$Data['URL'].'" target="_blank"><img src="'.$imageTag.'" alt="'.$Data['Title'].'" border="0" style="float: right; margin: 10px;" /></a>';
	$displayAmazonItem .= '</div>';
	$displayAmazonItem .= '<span class="amazonStore-title">'.$Data['Title']."</span><br />";
	if (isset($Data['Description'])) {
		$displayAmazonItem .= '<div class="amazonStore-description">'.$Data['Description'].'</div><br />';
	}
	$Feature_s = (isset($Data['Features']) ? $Data['Features'] : '');
	
	if (is_array($Feature_s)) {
		$displayAmazonItem .= '<span class="amazonStore-features-desc">'.__("Details",'appStoreAssistant').':</span><br />';
		
		$displayAmazonItem .= "<ul>";
		foreach ($Feature_s as $Feature) {
			if (is_array($Feature)) {
				foreach ($Feature as $Feature_Item) {
					$displayAmazonItem .= '<li>'.$Feature_Item.'</li>';
				}
			} else {
				$displayAmazonItem .= '<li>'.$Feature.'</li>';
			}
		}
		$displayAmazonItem .= "</ul>";
	}
	if ($Data['Manufacturer']) {
		$displayAmazonItem .= '<span class="amazonStore-publisher">'.__("Manufacturer",'appStoreAssistant').': '.$Data['Manufacturer']."</span><br />";
	}
	if ($Data['Status']) {
		$displayAmazonItem .= '<span class="amazonStore-status">'.__("Status",'appStoreAssistant').': '.$Data['Status'].'</span><br />';
	}
	if ($Data['ListPrice']) {
		$displayAmazonItem .= '<span class="amazonStore-listprice-desc">'.__("List Price",'appStoreAssistant').': </span>';
		$displayAmazonItem .= '<span class="amazonStore-listprice">'. $Data['ListPrice'] .'</span><br />';
	}
	if ($Data['Amount']) {
		$displayAmazonItem .= '<span class="amazonStore-amazonprice-desc">'.__("Amazon Price",'appStoreAssistant').': </span>';
		$displayAmazonItem .= '<span class="amazonStore-amazonprice">'. $Data['Amount'] .'</span><br />';
	}
	if (isset($Data->ItemAttributes->ReleaseDate)) {
		$displayAmazonItem .= '<span class="amazonStore-date">'.__("Disc Released",'appStoreAssistant').': '.date("F j, Y",strtotime($Data->ItemAttributes->ReleaseDate)).'</span><br />';
	}
	$displayAmazonItem .= '<br><div align="center">';
	$displayAmazonItem .= '<a href="'.$Data['URL'].'" TARGET="_blank">';
	$displayAmazonItem .= '<img src="'.plugins_url( 'images/amazon-buynow-button.png' , ASA_MAIN_FILE ).'" width="220" height="37" alt="Buy Now at Amazon" />';
	//$displayAmazonItem .= '<h2>Click here to view this item at Amazon.com</h2>';
	$displayAmazonItem .= '</a></div>';
	$displayAmazonItem .= '	<div style="clear:left;">&nbsp;</div>';
	$displayAmazonItem .= '</div>';
	return $displayAmazonItem;
} // end appStore_displayAmazonItem

function asa_clean_amazon_results($Result){

	//$formattedResults['Debug'] = '<pre>'.print_r($Result,true).'</pre>';
	//$formattedResults['Debug'] = '<!-- '.print_r($Result,true).'-->';
	
	$CurrencyCode = '';
    $Item 					= $Result['ItemsResult']['Items'][0];
	$formattedResults['ASIN'] = $Item['ASIN'];

	//Product Group
	$ProductGroup = $Item['ItemInfo']['Classifications']['ProductGroup']['DisplayValue'];
	$formattedResults['ProductGroup'] = $ProductGroup;

	//Images
    if (isset($Item['Images']['Primary']['Small']['URL'])) $formattedResults['SmallImage'] = $Item['Images']['Primary']['Small']['URL'];
    if (isset($Item['Images']['Primary']['Medium']['URL'])) $formattedResults['MediumImage'] = $Item['Images']['Primary']['Medium']['URL'];
    if (isset($Item['Images']['Primary']['Large']['URL'])) $formattedResults['LargeImage'] = $Item['Images']['Primary']['Large']['URL'];

	//Title
	$formattedResults['Title'] = $Item['ItemInfo']['Title']['DisplayValue'];

	//Affiliate URL
    $formattedResults['URL'] = $Item['DetailPageURL'];

	//Creator
	$formattedResults['Manufacturer'] = (isset($Item['ItemInfo']['ByLineInfo']['Manufacturer']['DisplayValue']) ? $Item['ItemInfo']['ByLineInfo']['Manufacturer']['DisplayValue'] : '');

	//Binding
	$formattedResults['Binding'] = (isset($Item['ItemInfo']['Classifications']['Binding']['DisplayValue']) ? $Item['ItemInfo']['Classifications']['Binding']['DisplayValue'] : '');

	//Pricing
    if(isset($Item['Offers']['Listings'][0]['Price']['DisplayAmount'])) {
    	$CurrencyCode = $Item['Offers']['Listings'][0]['Price']['Currency'];
    	$Amount = $Item['Offers']['Listings'][0]['Price']['DisplayAmount'].' '.$CurrencyCode;
    }else{
    	$Amount = 'Not Listed';
    }
  	$formattedResults['ListPrice'] = (isset($Item['Offers']['Listings'][0]['SavingBasis']['DisplayAmount']) ? $Item['Offers']['Listings'][0]['SavingBasis']['DisplayAmount'].' '.$Item['Offers']['Listings'][0]['SavingBasis']['Currency'] : $Amount);
	$formattedResults['CurrencyCode'] = (isset($Item['Offers']['Listings'][0]['SavingBasis']['Currency']) ? $Item['Offers']['Listings'][0]['SavingBasis']['Currency'] : $CurrencyCode);

    /*
  	if($lowestNewPrice=='Too low to display'){
  		$Amount = 'Too low to display';
  	}
  	*/
	$formattedResults['Amount'] = $Amount;

	// Status/Availability
	$formattedResults['Status'] = (isset($Item['Offers']['Listings'][0]['Availability']['Message']) ? $Item['Offers']['Listings'][0]['Availability']['Message'] : '');

	// Release Date
	if(isset($Item['ItemInfo']['ProductInfo']['ReleaseDate'])){
		$originalDate = $Item['ItemInfo']['ProductInfo']['ReleaseDate']['DisplayValue'];
		$formattedResults['ReleaseDate'] = date("d/m/Y", strtotime($originalDate));
	}else{
		$formattedResults['ReleaseDate'] = '';
	}
	
	//Language
	if(is_array($Item['ItemInfo']['ContentInfo']['Languages'])){
		$formattedResults['Languages'] = $Item['ItemInfo']['ContentInfo']['Languages']['DisplayValues'][0]['DisplayValue'];
	}

	//Contributors
	$formattedResults['Contributors'] = '';
	if(is_array($Item['ItemInfo']['ByLineInfo']['Contributors'])){
		$formattedResults['ContributorsCount'] = count($Item['ItemInfo']['ByLineInfo']['Contributors']);
		foreach ($Item['ItemInfo']['ByLineInfo']['Contributors'] as $Contributor) {
			$Contributors[] = $Contributor['Name'];
		}
		$formattedResults['Contributors'] = implode(' & ', $Contributors);
	}


// API Needs to be updated
	// OfferListingId
	$formattedResults['OfferListingId'] = '';

	//Description (was EditorialReviews not currently in API 5.0)
	$formattedResults['Description'] = '';
	if(is_array($Item['ItemInfo']['Features'])){
		if(is_array($Item['ItemInfo']['Features']['DisplayValues'])){
			$formattedResults['Description'] = '<ul>';
			foreach ($Item['ItemInfo']['Features']['DisplayValues'] as $bulletpoint) {
				$formattedResults['Description'] .= '<li>'.$bulletpoint.'</li>';
			}
			$formattedResults['Description'] .= '</ul>';
		}
	}

	// ProductGroup Specific Items
	switch ($ProductGroup) {
		//Books Product Group
		case "Book":
			$plural = ($formattedResults['ContributorsCount'] > 1 ? 's' :'');
			if($formattedResults['ContributorsCount'] > 1) $plural = 's';
			$formattedResults['Features']['Authors'] = 'Author'.$plural.': '.$formattedResults['Contributors'];

			$formattedResults['Features']['Edition'] = 'Current Edition';
			if(isset($Item['ItemInfo']['ContentInfo']['Edition']['DisplayValue'])){
				$formattedResults['Features']['Edition'] = __('Edition','appStoreAssistant').': '.$Item['ItemInfo']['ContentInfo']['Edition']['DisplayValue'];
			}
			$formattedResults['Features']['ISBN'] = '';
			if(is_array($Item['ItemInfo']['ExternalIds']['ISBNs']['DisplayValues'])){
				$plural = ($Item['ItemInfo']['ExternalIds']['ISBNs']['DisplayValues'] > 1 ? 's' :'');
				foreach ($Item['ItemInfo']['ExternalIds']['ISBNs']['DisplayValues'] as $ISBN) {
					$ISBNs[] = $ISBN;
				}
				$formattedResults['Features']['ISBN'] = 'ISBN'.$plural.':'.implode(', ', $ISBNs);
			}
			$formattedResults['Features']['Label'] = (isset($Item['ItemInfo']['ByLineInfo']['Brand']['DisplayValue']) ? __('Publisher','appStoreAssistant').': '.$Item['ItemInfo']['ByLineInfo']['Brand']['DisplayValue'] : '');
			$formattedResults['Features']['NumberOfPages'] = (isset($Item['ItemInfo']['ContentInfo']['PagesCount']['DisplayValue']) ? __('Pages','appStoreAssistant').': '.$Item['ItemInfo']['ContentInfo']['PagesCount']['DisplayValue'] : '');
			break;
		//DVD Product Group
		case "DVD":
			/// API Needs to be updated (See Sandbox)
			if (isset($Item['ItemInfo']['ContentRating']['AudienceRating']['DisplayValue'])) $formattedResults['Features']['Rating'] = __('Rating','appStoreAssistant').': '.$Item['ItemInfo']['ContentRating']['AudienceRating']['DisplayValue'];

			break;
		//Music Product Group
		case "Music":
			/// API Needs to be updated (See Sandbox)
			
			break;
		//Mobile Application Product Group
		case "Mobile Application":
			/// API Needs to be updated (See Sandbox)

			break;
		// Default Product Group
		default:
			break;
	}                                    

    return $formattedResults;  
}

function appStore_GetAmazonTracks($TracksArray) {
	if (isset($TracksArray[0]['Track'])) {
		$TracksDisplay = "Discs:<ul>";
		foreach ($TracksArray as $Disc => $Tracks) {
			$DiscNumber = $Disc + 1;
			$TracksDisplay .= "<li>Disc $DiscNumber:<ol>";
			foreach ($Tracks['Track'] as $Track) {
				if(isset($Track['@value'])) $TracksDisplay .= '<li>'.$Track['@value'].'</li>';
			}
			$TracksDisplay .= "</ol>";
		}
		$TracksDisplay .= "</ul>";
	} else {

		$TracksDisplay = "Tracks:<ol>";
		foreach ($TracksArray['Track'] as $Track) {
			if(isset($Track['@value'])) $TracksDisplay .= '<li>'.$Track['@value'].'</li>';
		}
		$TracksDisplay .= "</ol>";
	}

	return $TracksDisplay;
}

function fixCharacters($stringToCheck) {
	//Specific string replaces for ellipsis, etc that you dont want removed but replaced
	$theBad = 	array("“","”","‘","’","…","—","–","<div>","</div>");
	$theGood = array("\"","\"","'","'","...","-","-","","");
	$cleanedString = str_ireplace($theBad,$theGood,$stringToCheck);

	//$cleanedString = htmlentities($cleanedString,ENT_QUOTES);
	if (version_compare(phpversion(), '5.4', '<')) {
		// php version isn't high enough
		$cleanedString = str_replace('&Acirc;', '', $cleanedString);
	} else {
		$cleanedString = htmlentities($cleanedString,ENT_SUBSTITUTE);
		//$cleanedString = htmlentities($cleanedString,ENT_DISALLOWED);
	}
	
	/*
	$trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
    $trans[chr(134)] = '&dagger;';    // Dagger
    $trans[chr(135)] = '&Dagger;';    // Double Dagger
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
    $trans[chr(137)] = '&permil;';    // Per Mille Sign
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
    $trans[chr(149)] = '&bull;';    // Bullet
    $trans[chr(150)] = '&ndash;';    // En Dash
    $trans[chr(151)] = '&mdash;';    // Em Dash
    $trans[chr(152)] = '&tilde;';    // Small Tilde
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
    $trans['euro'] = '&euro;';    // euro currency symbol
    ksort($trans);
    
    foreach ($trans as $badchar => $goodcharacter) {
        $cleanedString = str_replace($badchar, $goodcharacter, $cleanedString);
    }
	
	*/	
		
	
	$theBad = 	array("&lt;","&gt;");
	$theGood = array("<",">");
	$cleanedString = str_ireplace($theBad,$theGood,$cleanedString); // Put Back HTML commands
	$cleanedString = preg_replace('@\x{FFFD}@u', '', $cleanedString); // Remove &#xFFFD; or &#65533; or 
	//echo "------SEALDEBUG--OUT2-------\r\r\r".print_r($cleanedString,true)."\r\r\r---------------";//Debug
	
	return $cleanedString;
}

function asa_amazon_api5_request($ItemID,$region,$accessKey,$secretKey,$partnertag){
	/* Copyright 2018 Amazon.com, Inc. or its affiliates. All Rights Reserved. */
	/* Licensed under the Apache License, Version 2.0. */

	// Put your Secret Key in place of **********
	$serviceName="ProductAdvertisingAPI";
	//$region="us-east-1";
	//$accessKey="**********";
	//$secretKey="**********";
	$payload="{"
			." \"ItemIds\": ["
			."  \"".$ItemID."\""
			." ],"
			." \"Resources\": ["
			."  \"Images.Primary.Small\","
			."  \"Images.Primary.Medium\","
			."  \"Images.Primary.Large\","
			."  \"ItemInfo.Classifications\","
			."  \"ItemInfo.ByLineInfo\","
			."  \"ItemInfo.ContentInfo\","
			."  \"ItemInfo.ContentRating\","
			."  \"ItemInfo.Features\","
			."  \"ItemInfo.ManufactureInfo\","
			."  \"ItemInfo.ExternalIds\","
			."  \"ItemInfo.ProductInfo\","
			."  \"ItemInfo.TechnicalInfo\","
			."  \"ItemInfo.Title\","
			."  \"Offers.Listings.Price\","
        	."  \"Offers.Listings.Availability.Message\","
			."  \"Offers.Listings.SavingBasis\""
			." ],"
			." \"PartnerTag\": \"".$partnertag."\","
			." \"PartnerType\": \"Associates\","
			." \"Marketplace\": \"www.amazon.com\""
			."}";
	$host="webservices.amazon.com";
	$uriPath="/paapi5/getitems";
	$awsv4 = new AwsV4 ($accessKey, $secretKey);
	$awsv4->setRegionName($region);
	$awsv4->setServiceName($serviceName);
	$awsv4->setPath ($uriPath);
	$awsv4->setPayload ($payload);
	$awsv4->setRequestMethod ("POST");
	$awsv4->addHeader ('content-encoding', 'amz-1.0');
	$awsv4->addHeader ('content-type', 'application/json; charset=utf-8');
	$awsv4->addHeader ('host', $host);
	$awsv4->addHeader ('x-amz-target', 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.GetItems');
	$headers = $awsv4->getHeaders ();
	$headerString = "";
	foreach ( $headers as $key => $value ) {
		$headerString .= $key . ': ' . $value . "\r\n";
	}
	$params = array (
			'http' => array (
				'header' => $headerString,
				'method' => 'POST',
				'content' => $payload
			)
		);
	$stream = stream_context_create ( $params );

	$fp = @fopen ( 'https://'.$host.$uriPath, 'rb', false, $stream );

	if (! $fp) {
		throw new Exception ( "Exception Occured" );
	}
	$response = @stream_get_contents ( $fp );
	if ($response === false) {
		throw new Exception ( "Exception Occured" );
	}
	
	//echo "<hr><pre>";print_r($response);echo "<hr>"; //DEBUG CODE

	$pxml = json_decode($response,true);
	return $pxml;

} // end asa_amazon_api5_request

class AwsV4 {

	private $accessKey = null;
	private $secretKey = null;
	private $path = null;
	private $regionName = null;
	private $serviceName = null;
	private $httpMethodName = null;
	private $queryParametes = array ();
	private $awsHeaders = array ();
	private $payload = "";

	private $HMACAlgorithm = "AWS4-HMAC-SHA256";
	private $aws4Request = "aws4_request";
	private $strSignedHeader = null;
	private $xAmzDate = null;
	private $currentDate = null;

	public function __construct($accessKey, $secretKey) {
		$this->accessKey = $accessKey;
		$this->secretKey = $secretKey;
		$this->xAmzDate = $this->getTimeStamp ();
		$this->currentDate = $this->getDate ();
	}

	function setPath($path) {
		$this->path = $path;
	}

	function setServiceName($serviceName) {
		$this->serviceName = $serviceName;
	}

	function setRegionName($regionName) {
		$this->regionName = $regionName;
	}

	function setPayload($payload) {
		$this->payload = $payload;
	}

	function setRequestMethod($method) {
		$this->httpMethodName = $method;
	}

	function addHeader($headerName, $headerValue) {
		$this->awsHeaders [$headerName] = $headerValue;
	}

	private function prepareCanonicalRequest() {
		$canonicalURL = "";
		$canonicalURL .= $this->httpMethodName . "\n";
		$canonicalURL .= $this->path . "\n" . "\n";
		$signedHeaders = '';
		foreach ( $this->awsHeaders as $key => $value ) {
			$signedHeaders .= $key . ";";
			$canonicalURL .= $key . ":" . $value . "\n";
		}
		$canonicalURL .= "\n";
		$this->strSignedHeader = substr ( $signedHeaders, 0, - 1 );
		$canonicalURL .= $this->strSignedHeader . "\n";
		$canonicalURL .= $this->generateHex ( $this->payload );
		return $canonicalURL;
	}

	private function prepareStringToSign($canonicalURL) {
		$stringToSign = '';
		$stringToSign .= $this->HMACAlgorithm . "\n";
		$stringToSign .= $this->xAmzDate . "\n";
		$stringToSign .= $this->currentDate . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "\n";
		$stringToSign .= $this->generateHex ( $canonicalURL );
		return $stringToSign;
	}

	private function calculateSignature($stringToSign) {
		$signatureKey = $this->getSignatureKey ( $this->secretKey, $this->currentDate, $this->regionName, $this->serviceName );
		$signature = hash_hmac ( "sha256", $stringToSign, $signatureKey, true );
		$strHexSignature = strtolower ( bin2hex ( $signature ) );
		return $strHexSignature;
	}

	public function getHeaders() {
		$this->awsHeaders ['x-amz-date'] = $this->xAmzDate;
		ksort ( $this->awsHeaders );

		// Step 1: CREATE A CANONICAL REQUEST
		$canonicalURL = $this->prepareCanonicalRequest ();

		// Step 2: CREATE THE STRING TO SIGN
		$stringToSign = $this->prepareStringToSign ( $canonicalURL );

		// Step 3: CALCULATE THE SIGNATURE
		$signature = $this->calculateSignature ( $stringToSign );

		// Step 4: CALCULATE AUTHORIZATION HEADER
		if ($signature) {
			$this->awsHeaders ['Authorization'] = $this->buildAuthorizationString ( $signature );
			return $this->awsHeaders;
		}
	}

	private function buildAuthorizationString($strSignature) {
		return $this->HMACAlgorithm . " " . "Credential=" . $this->accessKey . "/" . $this->getDate () . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "," . "SignedHeaders=" . $this->strSignedHeader . "," . "Signature=" . $strSignature;
	}

	private function generateHex($data) {
		return strtolower ( bin2hex ( hash ( "sha256", $data, true ) ) );
	}

	private function getSignatureKey($key, $date, $regionName, $serviceName) {
		$kSecret = "AWS4" . $key;
		$kDate = hash_hmac ( "sha256", $date, $kSecret, true );
		$kRegion = hash_hmac ( "sha256", $regionName, $kDate, true );
		$kService = hash_hmac ( "sha256", $serviceName, $kRegion, true );
		$kSigning = hash_hmac ( "sha256", $this->aws4Request, $kService, true );

		return $kSigning;
	}

	private function getTimeStamp() {
		return gmdate ( "Ymd\THis\Z" );
	}

	private function getDate() {
		return gmdate ( "Ymd" );
	}
}

class XML2Array {

	/**
	 * XML2Array: A class to convert XML to array in PHP
	 * It returns the array which can be converted back to XML using the Array2XML script
	 * It takes an XML string or a DOMDocument object as an input.
	 *
	 * See Array2XML: http://www.lalit.org/lab/convert-php-array-to-xml-with-attributes
	 *
	 * Author : Lalit Patel
	 * Website: http://www.lalit.org/lab/convert-xml-to-array-in-php-xml2array
	 * License: Apache License 2.0
	 *          http://www.apache.org/licenses/LICENSE-2.0
	 * Version: 0.1 (07 Dec 2011)
	 * Version: 0.2 (04 Mar 2012)
	 * 			Fixed typo 'DomDocument' to 'DOMDocument'
	 *
	 * Usage:
	 *       $array = XML2Array::createArray($xml);
	 */

    private static $xml = null;
	private static $encoding = 'UTF-8';

    /**
     * Initialize the root XML node [optional]
     * @param $version
     * @param $encoding
     * @param $format_output
     */
    public static function init($version = '1.0', $encoding = 'UTF-8', $format_output = true) {
        self::$xml = new DOMDocument($version, $encoding);
        self::$xml->formatOutput = $format_output;
		self::$encoding = $encoding;
    }

    /**
     * Convert an XML to Array
     * @param string $node_name - name of the root node to be converted
     * @param array $arr - aray to be converterd
     * @return DOMDocument
     */
    public static function &createArray($input_xml) {
        $xml = self::getXMLRoot();
		if(is_string($input_xml)) {
			$parsed = $xml->loadXML($input_xml);
			if(!$parsed) {
				throw new Exception('[XML2Array] Error parsing the XML string.');
			}
		} else {
			if(get_class($input_xml) != 'DOMDocument') {
				throw new Exception('[XML2Array] The input XML object should be of type: DOMDocument.');
			}
			$xml = self::$xml = $input_xml;
		}
		$array[$xml->documentElement->tagName] = self::convert($xml->documentElement);
        self::$xml = null;    // clear the xml node in the class for 2nd time use.
        return $array;
    }

    /**
     * Convert an Array to XML
     * @param mixed $node - XML as a string or as an object of DOMDocument
     * @return mixed
     */
    private static function &convert($node) {
		$output = array();

		switch ($node->nodeType) {
			case XML_CDATA_SECTION_NODE:
				$output['@cdata'] = trim($node->textContent);
				break;

			case XML_TEXT_NODE:
				$output = trim($node->textContent);
				break;

			case XML_ELEMENT_NODE:

				// for each child node, call the covert function recursively
				for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
					$child = $node->childNodes->item($i);
					$v = self::convert($child);
					if(isset($child->tagName)) {
						$t = $child->tagName;

						// assume more nodes of same kind are coming
						if(!isset($output[$t])) {
							$output[$t] = array();
						}
						$output[$t][] = $v;
					} else {
						//check if it is not an empty text node
						if($v !== '') {
							$output = $v;
						}
					}
				}

				if(is_array($output)) {
					// if only one node of its kind, assign it directly instead if array($value);
					foreach ($output as $t => $v) {
						if(is_array($v) && count($v)==1) {
							$output[$t] = $v[0];
						}
					}
					if(empty($output)) {
						//for empty nodes
						$output = '';
					}
				}

				// loop through the attributes and collect them
				if($node->attributes->length) {
					$a = array();
					foreach($node->attributes as $attrName => $attrNode) {
						$a[$attrName] = (string) $attrNode->value;
					}
					// if its an leaf node, store the value in @value instead of directly storing it.
					if(!is_array($output)) {
						$output = array('@value' => $output);
					}
					$output['@attributes'] = $a;
				}
				break;
		}
		return $output;
    }

    /*
     * Get the root XML node, if there isn't one, create it.
     */
    private static function getXMLRoot(){
        if(empty(self::$xml)) {
            self::init();
        }
        return self::$xml;
    }
}

?>