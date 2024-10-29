(function() {

	function addASAButton(ed, url){
		ed.addButton('asa_app', {
			title : 'ASA: App shortcode',
			image : url+'/images/AppStore_Button.png',
			onclick : function() {
				ed.windowManager.open({
					title: 'ASA: App Store shortcode',
					body: [
						{type: 'textbox', name: 'appID', label: 'App Store ID'},
						{type: 'textbox', name: 'moreinfotextEntered', label: 'More Info Text (optional)'}
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						idPattern = /([0-9]+)/;
						var m = idPattern.exec(e.data.appID);
						moreinfotextPattern = /([0-9a-zA-Z ]+)/;					
						var mit = 'open in App Store...';
						var mitProcessed = moreinfotextPattern.exec(e.data.moreinfotextEntered);
						if (mitProcessed != null && mitProcessed != 'undefined') mit = mitProcessed[0];
						var shortcode = '[asa_item id="'+m[1]+'" more_info_text="'+mit+'"]';
						if (m != null && m != 'undefined') ed.insertContent(shortcode);
					}
				});
			}				
		});  
	}
	function addiTunesButton(ed, url){
		ed.addButton('itunes_store', {
			title : 'ASA: iTunes shortcode',
			image : url+'/images/iTunes_Button.png',
			onclick : function() {
				ed.windowManager.open({
					title: 'ASA: iTunes shortcode',
					body: [
						{type: 'textbox', name: 'iTunesID', label: 'iTunes Store ID'},
						{type: 'textbox', name: 'moreinfotextEntered', label: 'More Info Text (optional)'}
					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						idPattern = /([0-9]+)/;
						var m = idPattern.exec(e.data.iTunesID);
						moreinfotextPattern = /([0-9a-zA-Z ]+)/;				
						var mit = 'open in iTunes...';
						var mitProcessed = moreinfotextPattern.exec(e.data.moreinfotextEntered);
						if (mitProcessed != null && mitProcessed != 'undefined') mit = mitProcessed[0];
						var shortcode = '[asa_item id="'+m[1]+'" more_info_text="'+mit+'"]';
						if (m != null && m != 'undefined') ed.insertContent(shortcode);
					}
				});
			}				
		});  
	}
	function addASAFButton(ed, url){
		var example = "http://itunes.apple.com/us/rss/toppaidmacapps/limit=25";
		ed.addButton('asaf_atomfeed', {
			title : 'ASA: Apple ATOM Feed shortcode',
			image : url+'/images/asaf_Button.png',
			onclick : function() {
				ed.windowManager.open({
					title: 'ASA: Apple ATOM Feed shortcode',
					description: example,
					body: [
						{type: 'label', text: "Example:"},
						{type: 'label', text: example},
						{type: 'textbox', name: 'atomfeed', label: 'ATOM/RSS Feed URL'},
						{type: 'textbox', name: 'moreinfotextEntered', label: 'More Info Text (optional)'}

					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						feedPattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
						var m = feedPattern.exec(e.data.iTunesID);
						moreinfotextPattern = /([0-9a-zA-Z ]+)/;
						var mit = 'open in Store...';
						var mitProcessed = moreinfotextPattern.exec(e.data.moreinfotextEntered);
						if (mitProcessed != null && mitProcessed != 'undefined') mit = mitProcessed[0];
						var shortcode = '[asaf_atomfeed atomurl="'+m[0]+'" more_info_text="'+mit+'"]';
						if (m != null && m != 'undefined') ed.insertContent(shortcode);
					}
				});
			}				
		});  
	}
	function addAmazonButton(ed, url){
		ed.addButton('asa_amazon', {
			title : 'ASA: Amazon.com shortcode',
			image : url+'/images/aicon.png',
			onclick : function() {
			
				ed.windowManager.open({
					title: 'ASA: Amazon.com shortcode',
					body: [
						{type: 'textbox', name: 'amazonID', label: 'Amazon.com Item #'},
						{type: 'textbox', name: 'linktextEntered', label: 'Link Text (optional)'},
						{type: 'listbox', 
							name: 'showprice', 
							label: 'Show Price', 
							'values': [
								{text: 'yes', value: 'yes'},
								{text: 'no', value: 'no'}
							]
						},
						{type: 'listbox', 
							name: 'textmode', 
							label: 'Text Mode', 
							'values': [
								{value: 'defaulttext', text: 'Default Text'},
								{value: 'linktext', text: 'Link Text'},
								{value: 'itemname', text: 'Item Name'}
							]
						},
						{type: 'listbox', 
							name: 'mode', 
							label: 'Mode', 
							'values': [
								{value: 'both', text: 'Button & Text'},
								{value: 'button', text: 'Button Only'},
								{value: 'text', text: 'Text Only'}
							]
						}

					],
					onsubmit: function(e) {
						// Insert content when the window form is submitted
						idPattern = /([0-9a-zA-Z]+)/;
						var m = idPattern.exec(e.data.amazonID);
						linktextPattern = /([0-9a-zA-Z ]+)/;
						var lt = linktextPattern.exec(e.data.linktextEntered);
						var shortcode = '[amazon_item_link asin="'+m[0]+'" textmode="'+e.data.textmode+'" mode="'+e.data.mode+'" showprice="'+e.data.showprice+'" linktext="'+lt[0]+'"]';
						if (m != null && m != 'undefined') ed.insertContent(shortcode);
					}
				});
			}
		});  
	}


	tinymce.create('tinymce.plugins.AppStoreAssistant', {  
        init : function(ed, url) {
            addASAButton(ed,url);
            addiTunesButton(ed,url);  
            addASAFButton(ed,url);  
            addAmazonButton(ed,url);  
        },  
        createControl : function(n, cm) {  
            return null;  
        },
        getInfo : function() {
            return {
                longname : "App Store Assistent Shortcode",
                author : 'Scott Immerman',
                authorurl : 'http://theiphoneappslist.com/',
                infourl : 'http://theiphoneappslist.com/',
                version : "4.0"
            };
        }
  
    });  
    tinymce.PluginManager.add('asa_mce', tinymce.plugins.AppStoreAssistant);

})();