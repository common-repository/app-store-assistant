<input type="hidden" name="appStore_options[checkboxedoptions]" value="displayLinkToFooter,cache_images_locally" />
<?php
if (version_compare(phpversion(), '5.4', '<')) {
    // php version isn't high enough
?>
<h2 class="asa_admin"><?php _e('Warning!', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<div class="asa_admin_element">
			<p class="asa_admin_warning">Warning: Your PHP version of <?php echo phpversion(); ?> is below the required version 5.4.</p>
			<p><?php _e('Some features may not work correctly. It is recommended that you upgrade to a current version of PHP.', 'appStoreAssistant' ); ?></p>

		</div>
	</div>
<?php
}
// Load Countries & Languages
$availableCountries = loadCountries("normal");
$countryCodes = loadCountries("reverse");
$languages  = loadLanguages("byName");
$languageCodes  = loadLanguages("byCode");

?>



<h2 class="asa_admin"><?php _e('Setup', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
		<div class="asa_admin_element">
		
	<section>
	  <h3><?php _e('Show link to plugin site in footer', 'appStoreAssistant' ); ?></h3>
	  	<div class="checkboxOne">
	  		<input type="checkbox" value="yes" id="checkboxOneInput" name="appStore_options[displayLinkToFooter]" <?php if ($options['displayLinkToFooter'] == "yes") echo 'checked'; ?> />
		  	<label for="checkboxOneInput"></label>
	  	</div>
	</section>
		
<p class="asa_admin_warning"><?php _e("By selecting the above box, a link will be placed at the bottom of your WordPress site giving credit to this plugin. This link will contain the page that it is displayed on and the version number of the plugin. When the link is clicked it will share this information with our server. The information will allow us to better understand how the plugin is being used and to make further improvements. This is completely optional, and the plug-in will work just fine even if you don't select this option. but we ask that you do select it. If you reset your settings it will be off by default.", 'appStoreAssistant' ); ?></p>
		<p><?php _e('An Example link for this site would be', 'appStoreAssistant' ); ?> <?php echo 'http://theiphoneappslist.com/index.php?v='.urlencode(plugin_get_version())."&ac=".urlencode(appStore_setting('affiliatepartnerid')).'&link='.urlencode(site_url()); ?></p></div>
	</div>
	
<h2 class="asa_admin"><?php _e('Localization', 'appStoreAssistant' ); ?></h2>
	<div class="asa_admin">
				  <?php
				  	echo '<h3>'.__('Current Settings:', 'appStoreAssistant' ).'</h3>';
				  	echo '<ul class="asa_settingslist"><li>'.__('Country', 'appStoreAssistant' );
				  	echo ': <b>'.$options['store_continent'].'/'.$countryCodes[$options['store_country']].'</b></li>';
				  	echo '<li>'.__('Language', 'appStoreAssistant' );
				  	echo ': <b>'.$languageCodes[$options['store_language']].'</b></li>';
				  	echo '<li>'.__('Currency Type', 'appStoreAssistant' );
				  	echo ': <b>'.$options['currency_format'].'</b></li>';
				  	echo '<li>'.__('iTunes/App Stores Badge Language', 'appStoreAssistant' );
				  	echo ': <b>'.$options['store_badge_language'].'</b></li>';
				  	echo '</ul>';
				  	//print_r($languageCodes);
				  	//echo "------".$options['store_language']."-----";
				  	?>
		<div class="asa_admin_element"><?php _e('Currency Type', 'appStoreAssistant' ); ?>: <select name='appStore_options[currency_format]'>
			<option value="USD" <?php if ($options['currency_format'] == "USD") echo 'selected'; ?>>US ($ and &cent;)</option>
			<option value="EUR" <?php if ($options['currency_format'] == "EUR") echo 'selected'; ?>>Euro (&euro;)</option>
			<option value="GBP" <?php if ($options['currency_format'] == "GBP") echo 'selected'; ?>>United Kingdom Pound (&pound;)</option>
			<option value="NOK" <?php if ($options['currency_format'] == "NOK") echo 'selected'; ?>>Norway Krone (kr)</option>
			<option value="SEK" <?php if ($options['currency_format'] == "SEK") echo 'selected'; ?>>Sweden Krona (kr)</option>
			<option value="JPY" <?php if ($options['currency_format'] == "JPY") echo 'selected'; ?>>Japan Yen &yen;</option>
		</select></div>
		<div class="asa_admin_element">



<script type="text/javascript" charset="utf-8">
	jQuery(function($) {
		/* For jquery.chained.js */
		$("#country").chained("#continent");
		$("#language").chained("#country");
	
		$("#c").chained("#a,#b");
  });
</script>		
<?php _e("Show results from this country's store", 'appStoreAssistant' ); ?>: 
<select id="continent" name="appStore_options[store_continent]">
  <option value="">Choose Continent</option>
	<?php  
		reset($availableCountries);
		while (list($key, $countries) = each($availableCountries)) {
			$keyCode = str_replace(' ', '', $key);
			echo '<option value="'.$keyCode.'"';
			if ($options['store_continent'] == $key) echo ' selected';
			echo '>'.$key.'</option>'."\n";
		}
	?>  
</select>
<select id="country" name="appStore_options[store_country]">
  <option value="">Choose Country</option>
	<?php
	reset($availableCountries);
	while (list($key, $countries) = each($availableCountries)) {
		$keyCode = str_replace(' ', '', $key);
		foreach ($countries as $countryCode => $countryName) {
			echo '  <option value="'.$countryCode.'" class="'.$keyCode.'"';
			if ($options['store_country'] == $countryCode) echo ' selected';
			echo '>'.$countryName.'</option>'."\n";
		}	
	}
	?>
</select>

<br />
<?php _e('Show results using this language', 'appStoreAssistant' ); ?>: 
<select id="language" name="appStore_options[store_language]">
  <option value="">Choose Language</option>
	<?php  
		reset($availableCountries);
		reset($languages);
		while (list($key, $countries) = each($availableCountries)) {
			foreach ($countries as $countryCode => $countryName) {
				echo '  <option value="NATIVE" class="'.$countryCode.'">Native</option>'."\n";
				foreach ($languages[$countryCode] as $languageCode => $languageName) {
					echo '  <option value="'.$languageCode.'" class="'.$countryCode.'"';
					if ($options['store_language'] == $languageCode) echo ' selected';
					echo '>'.$languageName.'</option>'."\n";
				}				
			}	
		}
	?>  
</select>		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		</div>
				<p class="asa_admin_warning">(<?php _e('Cached app data must be cleared for change to take effect', 'appStoreAssistant' ); ?>. See <b><a href="<?php echo admin_url()."admin.php?page=appStore_sm_utilities&tab=clearcache"; ?>"><?php _e('Utilities', 'appStoreAssistant' ); ?> -> <?php _e('Clear Cache', 'appStoreAssistant' ); ?></a></b>.)</p>
		<div class="asa_admin_element"><?php _e('iTunes/App Stores Badge Language', 'appStoreAssistant' ); ?>: <select name='appStore_options[store_badge_language]'>
			<option value="US-UK" <?php if ($options['store_badge_language'] == "US-UK") echo 'selected'; ?>>English</option>
			<option value="CZ" <?php if ($options['store_badge_language'] == "CZ") echo 'selected'; ?>>Čeština</option>
			<option value="DE" <?php if ($options['store_badge_language'] == "DE") echo 'selected'; ?>>Deutsch</option>
			<option value="ES" <?php if ($options['store_badge_language'] == "ES") echo 'selected'; ?>>Español</option>
			<option value="ESLA_MX" <?php if ($options['store_badge_language'] == "ESLA_MX") echo 'selected'; ?>>Español Latino</option>
			<option value="FR" <?php if ($options['store_badge_language'] == "FR") echo 'selected'; ?>>Français</option>
			<option value="IT" <?php if ($options['store_badge_language'] == "IT") echo 'selected'; ?>>Italiano</option>
			<option value="NO" <?php if ($options['store_badge_language'] == "NO") echo 'selected'; ?>>Norsk</option>
			<option value="PL" <?php if ($options['store_badge_language'] == "PL") echo 'selected'; ?>>Polski</option>
			<option value="RU" <?php if ($options['store_badge_language'] == "RU") echo 'selected'; ?>>Pусский</option>
			<option value="FI" <?php if ($options['store_badge_language'] == "FI") echo 'selected'; ?>>Suomi</option>
			<option value="SE" <?php if ($options['store_badge_language'] == "SE") echo 'selected'; ?>>Svenska</option>
			<option value="FI" <?php if ($options['store_badge_language'] == "FI") echo 'selected'; ?>>Tagalog</option>
			<option value="AR" <?php if ($options['store_badge_language'] == "AR") echo 'selected'; ?>>العربية</option>
			<option value="KR" <?php if ($options['store_badge_language'] == "KR") echo 'selected'; ?>>한국어</option>
			<option value="JP" <?php if ($options['store_badge_language'] == "JP") echo 'selected'; ?>>日本語</option>
			<option value="CN" <?php if ($options['store_badge_language'] == "CN") echo 'selected'; ?>>简体中文</option>
			<option value="HK_TW" <?php if ($options['store_badge_language'] == "HK_TW") echo 'selected'; ?>>繁體中文</option>
		</select></div>
	</div>
		
<h2 class="asa_admin"><?php _e('Cache Settings', 'appStoreAssistant' ); ?></h2>
   	<div class="asa_admin">
		<div class="asa_admin_element">
			<section>
			  <h3><?php _e('Cache images locally', 'appStoreAssistant' ); ?></h3>
				<div class="checkboxTwo">
					<input type="checkbox" value="1" id="checkboxTwoInput" name="appStore_options[cache_images_locally]" <?php if ($options['cache_images_locally'] == "1") echo 'checked'; ?> />
					<label for="checkboxTwoInput"></label>
				</div>
			</section>
			<p class="asa_admin_explain"><?php
			echo __("This will load icons, screenshots, etc. from this server instead of using Apple's CDN server.", 'appStoreAssistant' );
			echo '<br />';
			echo sprintf( __( 'The %s directory MUST be writeable for this option to have any effect', 'appStoreAssistant' ), '<b>'.$upload_dir['basedir'].'</b>');
			echo '</p>';
			echo '<p class="asa_admin_warning">(';
			_e('Cached app data must be cleared for change to take effect', 'appStoreAssistant' );
			echo '. See <b><a href="'.admin_url().'admin.php?page=appStore_sm_utilities&tab=clearcache" >';
			echo __('Utilities', 'appStoreAssistant' ).' -> '.__('Clear Cache', 'appStoreAssistant' ).'</a></b>.)</p>';
			?>
		</div>
    	<div class="asa_admin_element"><?php _e('Data cache time', 'appStoreAssistant' ); ?>: <select name='appStore_options[cache_time_select_box]'>
			<?php $cache_intervals = array(
										'Don\'t cache'=>0,
										'1 minute'=>1*60,
										'5 minutes'=>5*60,
										'10 minutes'=>10*60,
										'30 minutes'=>30*60,
										'1 hour'=>1*60*60,
										'6 hours'=>6*60*60,
										'12 hours'=>12*60*60,
										'24 hours'=>24*60*60,
										'1 Week'=>24*60*60*7,
										'1 Month'=>24*60*60*7*30,
										'1 Year'=>24*60*60*7*30*365
									);
			
			foreach ($cache_intervals as $key => $value) {
				echo '<option value="' . $value . '" ' . selected($value, $options['cache_time_select_box']) . '>' . $key . '</option>';
			}?></select><br />
		<p class="asa_admin_explain"><?php _e("This option determines how long before the plugin requests new data from Apple's servers. You can clear the cached app data via the Utilities section.", 'appStoreAssistant' ); ?></p>
		</div>
	</div>
<?php

function loadCountries($mode = "normal") {
	$countries['Asia'] = [
		"AM" => "Armenia",
		"AZ" => "Azerbaijan",
		"BH" => "Bahrain",
		"BD" => "Bangladesh",
		"BT" => "Bhutan",
		"IO" => "British Indian Ocean Territory",
		"BN" => "Brunei",
		"KH" => "Cambodia",
		"CN" => "China",
		"CX" => "Christmas Island",
		"CC" => "Cocos [Keeling] Islands",
		"GE" => "Georgia",
		"HK" => "Hong Kong",
		"IN" => "India",
		"ID" => "Indonesia",
		"IR" => "Iran",
		"IQ" => "Iraq",
		"IL" => "Israel",
		"JP" => "Japan",
		"JO" => "Jordan",
		"KZ" => "Kazakhstan",
		"KW" => "Kuwait",
		"KG" => "Kyrgyzstan",
		"LA" => "Laos",
		"LB" => "Lebanon",
		"MO" => "Macao",
		"MY" => "Malaysia",
		"MV" => "Maldives",
		"MN" => "Mongolia",
		"MM" => "Myanmar [Burma]",
		"NP" => "Nepal",
		"KP" => "North Korea",
		"OM" => "Oman",
		"PK" => "Pakistan",
		"PS" => "Palestine",
		"PH" => "Philippines",
		"QA" => "Qatar",
		"SA" => "Saudi Arabia",
		"SG" => "Singapore",
		"KR" => "South Korea",
		"LK" => "Sri Lanka",
		"SY" => "Syria",
		"TW" => "Taiwan",
		"TJ" => "Tajikistan",
		"TH" => "Thailand",
		"TR" => "Turkey",
		"TM" => "Turkmenistan",
		"AE" => "United Arab Emirates",
		"UZ" => "Uzbekistan",
		"VN" => "Vietnam",
		"YE" => "Yemen"
		];
	$countries['Europe'] = [    
		"AL" => "Albania",
		"AD" => "Andorra",
		"AT" => "Austria",
		"BY" => "Belarus",
		"BE" => "Belgium",
		"BA" => "Bosnia and Herzegovina",
		"BG" => "Bulgaria",
		"HR" => "Croatia",
		"CY" => "Cyprus",
		"CZ" => "Czechia",
		"DK" => "Dencontinent",
		"EE" => "Estonia",
		"FO" => "Faroe Islands",
		"FI" => "Finland",
		"FR" => "France",
		"DE" => "Germany",
		"GI" => "Gibraltar",
		"GR" => "Greece",
		"GG" => "Guernsey",
		"HU" => "Hungary",
		"IS" => "Iceland",
		"IE" => "Ireland",
		"IM" => "Isle of Man",
		"IT" => "Italy",
		"JE" => "Jersey",
		"XK" => "Kosovo",
		"LV" => "Latvia",
		"LI" => "Liechtenstein",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"MK" => "Macedonia",
		"MT" => "Malta",
		"MD" => "Moldova",
		"MC" => "Monaco",
		"ME" => "Montenegro",
		"NL" => "Netherlands",
		"NO" => "Norway",
		"PL" => "Poland",
		"PT" => "Portugal",
		"RO" => "Romania",
		"RU" => "Russia",
		"SM" => "San Marino",
		"RS" => "Serbia",
		"SK" => "Slovakia",
		"SI" => "Slovenia",
		"ES" => "Spain",
		"SJ" => "Svalbard and Jan Mayen",
		"SE" => "Sweden",
		"CH" => "Switzerland",
		"UA" => "Ukraine",
		"GB" => "United Kingdom",
		"VA" => "Vatican City",
		"AX" => "Åland"
		];
	$countries['Africa'] = [    
		"DZ" => "Algeria",
		"AO" => "Angola",
		"BJ" => "Benin",
		"BW" => "Botswana",
		"BF" => "Burkina Faso",
		"BI" => "Burundi",
		"CM" => "Cameroon",
		"CV" => "Cape Verde",
		"CF" => "Central African Republic",
		"TD" => "Chad",
		"KM" => "Comoros",
		"CD" => "Democratic Republic of the Congo",
		"DJ" => "Djibouti",
		"EG" => "Egypt",
		"GQ" => "Equatorial Guinea",
		"ER" => "Eritrea",
		"ET" => "Ethiopia",
		"GA" => "Gabon",
		"GM" => "Gambia",
		"GH" => "Ghana",
		"GN" => "Guinea",
		"GW" => "Guinea-Bissau",
		"CI" => "Ivory Coast",
		"KE" => "Kenya",
		"LS" => "Lesotho",
		"LR" => "Liberia",
		"LY" => "Libya",
		"MG" => "Madagascar",
		"MW" => "Malawi",
		"ML" => "Mali",
		"MR" => "Mauritania",
		"MU" => "Mauritius",
		"YT" => "Mayotte",
		"MA" => "Morocco",
		"MZ" => "Mozambique",
		"NA" => "Namibia",
		"NE" => "Niger",
		"NG" => "Nigeria",
		"CG" => "Republic of the Congo",
		"RW" => "Rwanda",
		"RE" => "Réunion",
		"SH" => "Saint Helena",
		"SN" => "Senegal",
		"SC" => "Seychelles",
		"SL" => "Sierra Leone",
		"SO" => "Somalia",
		"ZA" => "South Africa",
		"SS" => "South Sudan",
		"SD" => "Sudan",
		"SZ" => "Swaziland",
		"ST" => "São Tomé and Príncipe",
		"TZ" => "Tanzania",
		"TG" => "Togo",
		"TN" => "Tunisia",
		"UG" => "Uganda",
		"EH" => "Western Sahara",
		"ZM" => "Zambia",
		"ZW" => "Zimbabwe"
		];
	$countries['Oceania'] = [    
		"AS" => "American Samoa",
		"AU" => "Australia",
		"CK" => "Cook Islands",
		"TL" => "East Timor",
		"FJ" => "Fiji",
		"PF" => "French Polynesia",
		"GU" => "Guam",
		"KI" => "Kiribati",
		"MH" => "Marshall Islands",
		"FM" => "Micronesia",
		"NR" => "Nauru",
		"NC" => "New Caledonia",
		"NZ" => "New Zealand",
		"NU" => "Niue",
		"NF" => "Norfolk Island",
		"MP" => "Northern Mariana Islands",
		"PW" => "Palau",
		"PG" => "Papua New Guinea",
		"PN" => "Pitcairn Islands",
		"WS" => "Samoa",
		"SB" => "Solomon Islands",
		"TK" => "Tokelau",
		"TO" => "Tonga",
		"TV" => "Tuvalu",
		"UM" => "U.S. Minor Outlying Islands",
		"VU" => "Vanuatu",
		"WF" => "Wallis and Futuna"
		];
	$countries['North America'] = [    
		"AI" => "Anguilla",
		"AG" => "Antigua and Barbuda",
		"AW" => "Aruba",
		"BS" => "Bahamas",
		"BB" => "Barbados",
		"BZ" => "Belize",
		"BM" => "Bermuda",
		"BQ" => "Bonaire",
		"VG" => "British Virgin Islands",
		"CA" => "Canada",
		"KY" => "Cayman Islands",
		"CR" => "Costa Rica",
		"CU" => "Cuba",
		"CW" => "Curacao",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"SV" => "El Salvador",
		"GL" => "Greenland",
		"GD" => "Grenada",
		"GP" => "Guadeloupe",
		"GT" => "Guatemala",
		"HT" => "Haiti",
		"HN" => "Honduras",
		"JM" => "Jamaica",
		"MQ" => "Martinique",
		"MX" => "Mexico",
		"MS" => "Montserrat",
		"NI" => "Nicaragua",
		"PA" => "Panama",
		"PR" => "Puerto Rico",
		"BL" => "Saint Barthélemy",
		"KN" => "Saint Kitts and Nevis",
		"LC" => "Saint Lucia",
		"MF" => "Saint Martin",
		"PM" => "Saint Pierre and Miquelon",
		"VC" => "Saint Vincent and the Grenadines",
		"SX" => "Sint Maarten",
		"TT" => "Trinidad and Tobago",
		"TC" => "Turks and Caicos Islands",
		"VI" => "U.S. Virgin Islands",
		"US" => "United States"
		];
	$countries['Antarctica'] = [    
		"AQ" => "Antarctica",
		"BV" => "Bouvet Island",
		"TF" => "French Southern Territories",
		"HM" => "Heard Island and McDonald Islands",
		"GS" => "South Georgia and the South Sandwich Islands"
		];
	$countries['South America'] = [    
		"AR" => "Argentina",
		"BO" => "Bolivia",
		"BR" => "Brazil",
		"CL" => "Chile",
		"CO" => "Colombia",
		"EC" => "Ecuador",
		"FK" => "Falkland Islands",
		"GF" => "French Guiana",
		"GY" => "Guyana",
		"PY" => "Paraguay",
		"PE" => "Peru",
		"SR" => "Suriname",
		"UY" => "Uruguay",
		"VE" => "Venezuela"
		];
		
	if ($mode == "reverse") {
		$countriesByCode = "";
		while (list($key, $val) = each($countries)) {
			foreach ($val as $languageCode => $countryName) {
				$countriesByCode[$languageCode] = $countryName;
			}
		}	
		return $countriesByCode;
	} else {
		return $countries;
	}

		
		
		
	return $countries;
}

function loadLanguages($mode = "byName") {
	$languages["AR"] = array("es_MX","en_GB");
	$languages["AU"] = array("en_AUS");
	$languages["AT"] = array("de_DE","en_GB");
	$languages["BE"] = array("fr_FR","nl_NL","en_GB");
	$languages["BZ"] = array("es_ES","en_GB");
	$languages["BO"] = array("es_MX","en_GB");
	$languages["BR"] = array("pt_BR","en_GB");
	$languages["CA"] = array("en_CA","fr_CA");
	$languages["CL"] = array("es_MX","en_GB");
	$languages["CN"] = array("zh_CN","en_GB");
	$languages["CO"] = array("es_MX","en_GB");
	$languages["CR"] = array("es_MX","en_GB");
	$languages["DK"] = array("da_DA","en_GB");
	$languages["DM"] = array("es_MX","en_GB");
	$languages["EC"] = array("es_MX","en_GB");
	$languages["SV"] = array("es_MX","en_GB");
	$languages["FI"] = array("fi_FI","en_GB");
	$languages["FR"] = array("fr_FR","en_GB");
	$languages["DE"] = array("de_DE","en_GB");
	$languages["GT"] = array("es_MX","en_GB");
	$languages["HN"] = array("es_MX","en_GB");
	$languages["HK"] = array("zh_TW","en_GB");
	$languages["ID"] = array("id_ID","en_GB");
	$languages["IT"] = array("it_IT","en_GB");
	$languages["JP"] = array("jp_JP","en_US");
	$languages["KR"] = array("ko_KR","en_GB");
	$languages["LU"] = array("fr_FR","de_DE","en_GB");
	$languages["MO"] = array("zh_TW","en_GB");
	$languages["MY"] = array("ms_MY","en_GB");
	$languages["MX"] = array("es_MX","en_GB");
	$languages["NL"] = array("nl_NL","en_GB");
	$languages["NI"] = array("es_MX","en_GB");
	$languages["NO"] = array("no_NO","en_GB");
	$languages["PA"] = array("es_MX","en_GB");
	$languages["PY"] = array("es_MX","en_GB");
	$languages["PE"] = array("es_MX","en_GB");
	$languages["PT"] = array("pt_PT","en_GB");
	$languages["DO"] = array("es_MX","en_GB");
	$languages["RU"] = array("ru_RU","en_GB");
	$languages["SG"] = array("zh_CN","en_GB");
	$languages["ES"] = array("es_ES","en_GB");
	$languages["SR"] = array("nl_NL","en_GB");
	$languages["SE"] = array("sv_SE","en_GB");
	$languages["CH"] = array("de_DE","fr_FR","it_IT","en_GB");
	$languages["TW"] = array("zh_TW","en_GB");
	$languages["TH"] = array("th_TH","en_GB");
	$languages["TR"] = array("tr_TR","en_GB");
	$languages["US"] = array("en_US","es_ES");
	$languages["UY"] = array("es_ES","en_GB");
	$languages["VE"] = array("es_MX","en_GB");
	$languages["VN"] = array("vi_VI","en_GB");

	$languageNames["es_MX"] = "Español Latino";
	$languageNames["en_GB"] = "English UK";
	$languageNames["en_AUS"] = "English Australian";
	$languageNames["de_DE"] = "Deutsch";
	$languageNames["fr_FR"] = "Français";
	$languageNames["nl_NL"] = "Dutch (Netherlands)";
	$languageNames["es_ES"] = "Español";
	$languageNames["pt_BR"] = "Portuguese (Brazil)";
	$languageNames["en_CA"] = "Canadian English";
	$languageNames["fr_CA"] = "Canadian Français";
	$languageNames["zh_CN"] = "简体中文";
	$languageNames["da_DA"] = "Danish";
	$languageNames["fi_FI"] = "Tagalog";
	$languageNames["zh_TW"] = "繁體中文";
	$languageNames["id_ID"] = "Indonesian";
	$languageNames["it_IT"] = "Italiano";
	$languageNames["jp_JP"] = "日本語";
	$languageNames["en_US"] = "English US";
	$languageNames["ko_KR"] = "한국어";
	$languageNames["ms_MY"] = "Malay (Malaysia)";
	$languageNames["no_NO"] = "Norsk";
	$languageNames["pt_PT"] = "Portuguese (Portugal)";
	$languageNames["ru_RU"] = "Pусский";
	$languageNames["sv_SE"] = "Svenska";
	$languageNames["th_TH"] = "Thai (Thailand)";
	$languageNames["tr_TR"] = "Turkish (Turkey)";
	$languageNames["vi_VI"] = "Vietnamese (Vietnam)";
	
	switch ($mode) {
  		case "byName":
			while (list($key, $val) = each($languages)) {
				$tempLanguageArray = "";
				foreach ($val as $languageCode) {
					$tempLanguageArray[$languageCode] = $languageNames[$languageCode];
				}
				$languagesTranslated[$key] = $tempLanguageArray;
			}	
			return $languagesTranslated;
			break;	
  		case "byCode":
			return $languageNames;
			break;	
		default:
			return $languages;
	}
}

?>