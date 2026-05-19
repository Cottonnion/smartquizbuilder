if(typeof jQuery === 'undefined'){
	SQBinit();
} else{
	jQuery(document).ready(function(){
		var id = jQuery('#sqbExternalScript').attr('data-id');
		var url = jQuery('#sqbExternalScript').attr('data-url');
		var path = jQuery('#sqbExternalScript').attr('data-path');

		var ajaxUrl = url;
		jQuery.post(ajaxUrl, {
			contentType:"application/json",
			dataType:'jsonp',
			id: id,
			url: url,
			path: path,
			externalScript: 'Y',
			crossDomain:true,
		}, function(response) {
			jQuery("#sqbExternalScript").after(response);
		});
	});
}

function SQBinit(){
	SQBaddJQuery();
	SQBaddBodyAndOnLoadScript(); 
}

function SQBaddJQuery(){
	var head = document.getElementsByTagName( 'head' )[0];
	var scriptjQuery = document.createElement( 'script' );
	scriptjQuery.type = 'text/javascript';
	scriptjQuery.id = 'jQuery'
	scriptjQuery.src = '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js';
	var script = document.getElementsByTagName( 'script' )[0];
	head.insertBefore(scriptjQuery, script);
}

function SQBaddBodyAndOnLoadScript(){
	var body = document.createElement('body')
	body.onload = 
	function()
	{
		SQBonloadFunction();
	};
}
 

function SQBonloadFunction(){
	 
	var id = jQuery('#sqbExternalScript').attr('data-id');
	var url = jQuery('#sqbExternalScript').attr('data-url');
	var path = jQuery('#sqbExternalScript').attr('data-path');

	var ajaxUrl = url;
	jQuery.post(ajaxUrl, {
		contentType:"application/json",
		dataType:'jsonp',
		id: id,
		url: url,
		path: path,
		externalScript: 'Y',
		crossDomain:true,
	}, function(response) {
		jQuery("#sqbExternalScript").after(response);
	});
} 

