/**
 * jQuery Lightbox Plugin (balupton edition) - Lightboxes for jQuery
 * Copyright (C) 2008 Benjamin Arthur Lupton
 * http://jquery.com/plugins/project/jquerylightbox_bal
 *
 * This file is part of jQuery Lightbox (balupton edition).
 * 
 * jQuery Lightbox (balupton edition) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * 
 * jQuery Lightbox (balupton edition) is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with jQuery Lightbox (balupton edition).  If not, see <http://www.gnu.org/licenses/>.
 *
 * @name jquery_lightbox: jquery.lightbox.js
 * @package jQuery Lightbox Plugin (balupton edition)
 * @version 1.3.7-final
 * @date April 25, 2009
 * @category jQuery plugin
 * @author Benjamin "balupton" Lupton {@link http://www.balupton.com}
 * @copyright (c) 2008 Benjamin Arthur Lupton {@link http://www.balupton.com}
 * @license GNU Affero General Public License - {@link http://www.gnu.org/licenses/agpl.html}
 * @example Visit {@link http://jquery.com/plugins/project/jquerylightbox_bal} for more information.
 */

 var J = jQuery.noConflict();
// Start of our jQuery Plugin
(function(J)
{	// Create our Plugin function, with J as the argument (we pass the jQuery object over later)
	// More info: http://docs.jquery.com/Plugins/Authoring#Custom_Alias
	
	// Debug
	if ( typeof J.log === 'undefined' ) {
		if ( !J.browser.safari && typeof window.console !== 'undefined' && typeof window.console.log === 'function' )
		{	// Use window.console
			J.log = function(){
				var args = [];
			    for(var i = 0; i < arguments.length; i++) {
			        args.push(arguments[i]);
			    }
			    window.console.log.apply(window.console, args);
			}
			J.console = {
				log:	J.log,
				debug:	window.console.debug	|| J.log,
				warn:	window.console.warn		|| J.log,
				error:	window.console.error	|| J.log,
				trace:	window.console.trace	|| J.log
			}
		}
		else
		{	// Don't use anything
			J.log = function ( ) { };
			J.console = {
				log:	J.log,
				debug:	J.log,
				warn:	J.log,
				error:	alert,
				trace:	J.log
			};
		}
	}
	
	// Pre-Req
	J.params_to_json = J.params_to_json || function ( params )
	{	// Turns a params string or url into an array of params
		// Adjust
		params = String(params);
		// Remove url if need be
		params = params.substring(params.indexOf('?')+1);
		// params = params.substring(params.indexOf('#')+1);
		// Change + to %20, the %20 is fixed up later with the decode
		params = params.replace(/\+/g, '%20');
		// Do we have JSON string
		if ( params.substring(0,1) === '{' && params.substring(params.length-1) === '}' )
		{	// We have a JSON string
			return eval(decodeURIComponent(params));
		}
		// We have a params string
		params = params.split(/\&|\&amp\;/);
		var json = {};
		// We have params
		for ( var i = 0, n = params.length; i < n; ++i )
		{
			// Adjust
			var param = params[i] || null;
			if ( param === null ) { continue; }
			param = param.split('=');
			if ( param === null ) { continue; }
			// ^ We now have "var=blah" into ["var","blah"]
			
			// Get
			var key = param[0] || null;
			if ( key === null ) { continue; }
			if ( typeof param[1] === 'undefined' ) { continue; }
			var value = param[1];
			// ^ We now have the parts
			
			// Fix
			key = decodeURIComponent(key);
			value = decodeURIComponent(value);
			try {
			    // value can be converted
			    value = eval(value);
			} catch ( e ) {
			    // value is a normal string
			}
			
			// Set
			// console.log({'key':key,'value':value}, split);
			var keys = key.split('.');
			if ( keys.length === 1 )
			{	// Simple
				json[key] = value;
			}
			else
			{	// Advanced
				var path = '';
				for ( ii in keys )
				{	//
					key = keys[ii];
					path += '.'+key;
					eval('json'+path+' = json'+path+' || {}');
				}
				eval('json'+path+' = value');
			}
			// ^ We now have the parts added to your JSON object
		}
		return json;
	};
	
	// Declare our class
	J.LightboxClass = function ( )
	{	// This is the handler for our constructor
		this.construct();
	};

	// Extend jQuery elements for Lightbox
	J.fn.lightbox = function ( options )
	{	// Init a el for Lightbox
		// Eg. J('#gallery a').lightbox();
		
		// If need be: Instantiate J.LightboxClass to J.Lightbox
		J.Lightbox = J.Lightbox || new J.LightboxClass();
		
		// Handle IE6 appropriatly
		if ( J.Lightbox.ie6 && !J.Lightbox.ie6_support )
		{	// We are IE6 and we want to ignore
			return this; // chain
		}
		
		// Establish options
		options = J.extend({start:false,events:true} /* default options */, options);
		
		// Get group
		var group = J(this);
		
		// Events?
		if ( options.events )
		{	// Add events
			J(group).unbind('click').click(function(){
				// Get obj
				var obj = J(this);
				// Get rel
				// var rel = J(obj).attr('rel');
				// Init group
				if ( !J.Lightbox.init(J(obj)[0], group) )
				{	return false;	}
				// Display lightbox
				if ( !J.Lightbox.start() )
				{	return false;	}
				// Cancel href
				return false;
			});
			// Add style
			J(group).addClass('lightbox-enabled');
		}
		
		// Start?
		if ( options.start )
		{	// Start
			// Get obj
			var obj = J(this);
			// Get rel
			// var rel = J(obj).attr('rel');
			// Init group
			if ( !J.Lightbox.init(J(obj)[0], group) )
			{	return this;	}
			// Display lightbox
			if ( !J.Lightbox.start() )
			{	return this;	}
		}
		
		// And chain
		return this;
	};
	
	// Define our class
	J.extend(J.LightboxClass.prototype,
	{	// Our LightboxClass definition
		
		// -----------------
		// Everyting to do with images
		
		images: {
			
			// -----------------
			// Variables
			
			// Our array of images
			list:[], /* [ {
				src: 'url to image',
				link: 'a link to a page',
				title: 'title of the image',
				name: 'name of the image',
				description: 'description of the image'
			} ], */
			
			// The current active image
			image: false,
			
			// -----------------
			// Functions
			
			prev: function ( image )
			{	// Get previous image
				
				// Get previous from current?
				if ( typeof image === 'undefined' )
				{	image = this.active();
					if ( !image ) { return image; }
				}
				
				// Is there a previous?
				if ( this.first(image) )
				{	return false;	}
				
				// Get the previous
				return this.get(image.index-1);
			},
			
			next: function ( image )
			{	// Get next image
				
				// Get next from current?
				if ( typeof image === 'undefined' )
				{	image = this.active();
					if ( !image ) { return image; }
				}
				
				// Is there a next?
				if ( this.last(image) )
				{	return false;	}
				
				// Get the next
				return this.get(image.index+1);
			},
			
			first: function ( image )
			{	//
				// Get the first image?
				if ( typeof image === 'undefined' )
				{	return this.get(0);	}
				
				// Are we the first?
				return image.index === 0;
			},
			
			last: function ( image )
			{	//
				// Get the last image?
				if ( typeof image === 'undefined' )
				{	return this.get(this.size()-1);	}
				
				// Are we the last?
				return image.index === this.size()-1;
			},
		
			single: function ( )
			{	// Are we only one
				return this.size() === 1;
			},
			
			size: function ( )
			{	// How many images do we have
				return this.list.length;
			},
			
			empty: function ( )
			{	// Are we empty
				return this.size() === 0;
			},
			
			clear: function ( )
			{	// Clear image arrray
				this.list = [];
				this.image = false;
			},
		
			active: function ( image )
			{	// Set or get the active image
				// Use false to reset
				
				// Get the active image?
				if ( typeof image === 'undefined' )
				{	return this.image;	}
				
				// Set the ative image
				if ( image !== false )
				{	// Make sure image exists
					image = this.get(image);
					if ( !image )
					{	// Error
						return image;
					}
				}
				
				// Set the active image
				this.image = image;
				return true;
			},
		
			add: function ( obj )
			{
				// Do we need to recurse?
				if ( obj[0] )
				{	// We have a lot of images
					for ( var i = 0; i < obj.length; i++ )
					{	this.add(obj[i]);	}
					return true;
				}
				
				// Default image
				
				// Try and create a image
				var image = this.create(obj);
				if ( !image ) { return image; }
				
				// Set image index
				image.index = this.size();
				
				// Push image
				this.list.push(image);
				
				// Success
				return true;
			},
			
			create: function ( obj )
			{	// Create image
				
				// Define
				var image = { // default
					src:	'',
					title:	'Untitled',
					description:	'',
					name:	'',
					index:	-1,
					color:	null,
					width:	null,
					height:	null,
					image:	true
				};
				
				// Create
				if ( obj.image )
				{	// Already a image, so copy over values
					image.src = obj.src || image.src;
					image.title = obj.title || image.title;
					image.description = obj.description || image.description;
					image.name = obj.name || image.name;
					image.color = obj.color || image.color;
					image.width = obj.width || image.width;
					image.height = obj.height || image.height;
					image.index = obj.index || image.index;
				}
				else if ( obj.tagName )
				{	// We are an element
					obj = J(obj);
					if ( obj.attr('src') || obj.attr('href') )
					{
						image.src = obj.attr('src') || obj.attr('href');
						image.title = obj.attr('title') || obj.attr('alt') || image.title;
						image.name = obj.attr('name') || '';
						image.color = obj.css('backgroundColor');
						// Extract description from title
						var s = image.title.indexOf(': ');
						if ( s > 0 )
						{	// Description exists
							image.description = image.title.substring(s+2) || image.description;
							image.title = image.title.substring(0,s) || image.title;
						}
					}
					else
					{	// Unsupported element
						image = false;
					}
				}
				else
				{	// Unknown
					image = false;
				}
				
				if ( !image )
				{	// Error
					J.console.error('We dont know what we have:', obj);
					return false;
				}
				
				// Success
				return image;
			},
			
			get: function ( image )
			{	// Get the active, or specified image
				
				// Establish image
				if ( typeof image === 'undefined' || image === null )
				{	// Get the active image
					return this.active();
				}
				else
				if ( typeof image === 'number' )
				{	// We have a index
					
					// Get image
					image = this.list[image] || false;
				}
				else
				{	// Create
					image = this.create(image);
					if ( !image ) { return false; }
					
					// Find
					var f = false;
					for ( var i = 0; i < this.size(); i++ )
					{
						var c = this.list[i];
						if ( c.src === image.src && c.title === image.title && c.description === image.description )
						{	f = c;	}
					}
					
					// Found?
					image = f;
				}
				
				// Determine image
				if ( !image )
				{	// Image doesn't exist
					J.console.error('The desired image does not exist: ', image, this.list);
					return false;
				}
				
				// Return image
				return image;
			},
			
			debug: function ( )
			{
				return J.Lightbox.debug(arguments);
			}
			
		},
		
		// -----------------
		// Variables
		
		constructed:		false,
		compressed:			null,
		
		// -----------------
		// Options
		
		src:				null,		// the source location of our js file
		baseurl:			null,
		
		files: {
			compressed: {
				js: {
					lightbox:	'include/jquery.lightbox.min.js',
					colorBlend:	'include/jquery.color.min.js'
				},
				css: {
					lightbox:	'templates/jquery.lightbox.css'
				}
			},
			uncompressed: {
				js: {
					lightbox:	'include/jquery.lightbox.js',
					colorBlend:	'include/jquery.color.js'
				},
				css: {
					lightbox:	'templates/jquery.lightbox.css'
				}
			},
			images: {
				loading:	'templates/images/loading.gif'
			}
		},
		
		text: {
			// For translating
			image:		'Image',
			of:			'of',
			close:		'Close X',
			closeInfo:	'You can also click anywhere outside the image to close.',
			download:	'Download.',
			help: {
				close:		'Click to close',
				interact:	'Hover to interact'
			},
			about: {
			}
		},
		
		keys: {
			close:	'c',
			prev:	'p',
			next:	'n'
		},
		
		handlers: {
			// For custom actions
			show:	null
		},
		
		opacity:		0.9,
		padding:		null,		// if null - autodetect
		
		speed:			400,		// Duration of effect, milliseconds
		
		rel:			'lightbox',	// What to look for in the rels
		
		auto_relify:	true,		// should we automaticly do the rels?
		
		auto_scroll:	'follow',	// should the lightbox scroll with the page? follow, disabled, ignore
		auto_resize:	true,		// true or false
		
		ie6:			null,		// are we ie6?
		ie6_support:	true,		// have ie6 support
		ie6_upgrade:	true,		// show ie6 upgrade message
		
		colorBlend:		null,		// null - auto-detect, true - force, false - no
		
		download_link:		true,	// Display the download link
		
		show_helper_text:	true,	// Display the helper text up the top right
		show_linkback:		true,	// true, false
		show_info:			'auto',	// auto - automaticly handle, true - force
		show_extended_info:	'auto',	// auto - automaticly handle, true - force	
		
		// names of the options that can be modified
		options:	['show_helper_text', 'auto_scroll', 'auto_resize', 'download_link', 'show_info', 'show_extended_info', 'ie6_support', 'ie6_upgrade', 'colorBlend', 'baseurl', 'files', 'text', 'show_linkback', 'keys', 'opacity', 'padding', 'speed', 'rel', 'auto_relify'],
		
		// -----------------
		// Functions
		
		construct: function ( options )
		{	// Construct our Lightbox
			
			// -------------------
			// Prepare
			
			// Initial construct
			var initial = typeof this.constructed === 'undefined' || this.constructed === false;
			this.constructed = true;
			
			// Perform domReady
			var domReady = initial;
			
			// Prepare options
			options = options || {};
			
			// -------------------
			// Handle files
			
			// Prepend function to use later
			var prepend = function(item, value) {
				if ( typeof item === 'object' ) {
					for (var i in item) {
						item[i] = prepend(item[i], value);
					}
				} else if ( typeof value === 'array' ) {
					for (var i=0,n=item.length; i<n; ++i) {
						item[i] = prepend(item[i], value);
					}
				} else {
					item = value+item;
				}
				return item;
			}
			
			// Add baseurl
			if ( initial && (typeof options.files === 'undefined') )
			{	// Load the files like default
				
				// Reset compressed
				this.compressed = null;
				
				// Get the src of the first script tag that includes our js file (with or without an appendix)
				var Jscript = J('script[src*='+this.files.compressed.js.lightbox+']:first');
				if ( Jscript.length !== 0 ) {
					// Compressed
					J.extend(true, this.files, this.files.compressed);
					this.compressed = true;
				} else {
					// Uncompressed
					Jscript = J('script[src*='+this.files.uncompressed.js.lightbox+']:first');
					if ( Jscript.length !== 0 ) {
						// Uncompressed
						J.extend(true, this.files, this.files.uncompressed);
						this.compressed = false;
					} else {
						// Nothing
					}
				}
				
				// Make sure we found ourselves
				if ( this.compressed === null )
				{	// We didn't
					J.console.error('Lightbox was not able to find it\'s javascript script tag necessary for auto-inclusion.');
					// We don't work with files anymore, so don't care for domReady
					domReady = false;
				}
				else
				{	// We found ourself
					
					// Grab the script src
					this.src = Jscript.attr('src');
					
					// The baseurl is the src up until the start of our js file
					this.baseurl = this.src.substring(0, this.src.indexOf(this.files.js.lightbox));
					
					// Prepend baseurl to files
					this.files = prepend(this.files, this.baseurl);
					
					// Now as we have source, we may have more params
					options = J.extend(options, J.params_to_json(this.src));
				}
				
			}
			else
			if ( typeof options.files === 'object' )
			{	// We have custom files
				// Prepend baseurl to files
				options.files = prepend(options.files, this.baseurl);
			}
			else
			{	// Don't have any files, so no need to perform domReady
				domReady = false;
			}
			
			// -------------------
			// Apply options
			
			for ( var i in this.options )
			{	// Cycle through the options
				var name = this.options[i];
				if ( (typeof options[name] === 'object') && (typeof this[name] === 'object') )
				{	// We have a group like text or files
					this[name] = J.extend(true, this[name], options[name]);
				}
				else if ( typeof options[name] !== 'undefined' )
				{	// We have that option, so apply it
					this[name] = options[name];
				}
			}	delete i;
			
			// -------------------
			// Figure out what to do
			
			// Handle IE6
			if ( initial && navigator.userAgent.indexOf('MSIE 6') >= 0 )
			{	// Is IE6
				this.ie6 = true;
			}
			else
			{	// We are not IE6
				this.ie6 = false;
			}
			
			// -------------------
			// Handle our DOM
			
			if ( domReady || typeof options.download_link !== 'undefined' ||  typeof options.colorBlend !== 'undefined' || typeof options.files === 'object' || typeof options.text === 'object' || typeof options.show_linkback !== 'undefined' || typeof options.scroll_with !== 'undefined' )
			{	// We have reason to handle the dom
				J(function() {
					// DOM is ready, so fire our DOM handler
					J.Lightbox.domReady();
				});
			}
			
			// -------------------
			// Finish Up
			
			// All good
			return true;
		},
		
		domReady: function ( )
		{
			// -------------------
			// Include resources
			
			// Grab resources
			var bodyEl = document.getElementsByTagName(J.browser.safari ? 'head' : 'body')[0];
			var stylesheets = this.files.css;
			var scripts = this.files.js;
			
			// Handle IE6 appropriatly
			if ( this.ie6 && this.ie6_upgrade )
			{	// Add the upgrade message
				scripts.ie6 = 'http://www.savethedevelopers.org/say.no.to.ie.6.js';
			}
			
			// colorBlend
			if ( this.colorBlend === true && typeof J.colorBlend === 'undefined' )
			{	// Force colorBlend
				this.colorBlend = true;
				// Leave file in place to be loaded
			}
			else
			{	// We either have colorBlend or we don't
				this.colorBlend = typeof J.colorBlend !== 'undefined';
				// Remove colorBlend file
				delete scripts.colorBlend;
			}
			
			// Include stylesheets
			for ( stylesheet in stylesheets )
			{
				var linkEl = document.createElement('link');
				linkEl.type = 'text/css';
				linkEl.rel = 'stylesheet';
				linkEl.media = 'screen';
				linkEl.href = stylesheets[stylesheet];
				linkEl.id = 'lightbox-stylesheet-'+stylesheet.replace(/[^a-zA-Z0-9]/g, '');
				J('#'+linkEl.id).remove();
				bodyEl.appendChild(linkEl);
			}
			
			// Include javascripts
			for ( script in scripts )
			{
				var scriptEl = document.createElement('script');
				scriptEl.type = 'text/javascript';
				scriptEl.src = scripts[script];
				scriptEl.id = 'lightbox-script-'+script.replace(/[^a-zA-Z0-9]/g, '');
				J('#'+scriptEl.id).remove();
				bodyEl.appendChild(scriptEl);
			}
			
			// Cleanup
			delete scripts;
			delete stylesheets;
			delete bodyEl;
			
			// -------------------
			// Append display
			
			// Append markup
			J('#lightbox,#lightbox-overlay').remove();
			J('body').append('<div id="lightbox-overlay"><div id="lightbox-overlay-text">'+(this.show_linkback?'<p><span id="lightbox-overlay-text-about"><a href="#" title="'+this.text.about.title+'">'+this.text.about.text+'</a></span></p><p>&nbsp;</p>':'')+(this.show_helper_text?'<p><span id="lightbox-overlay-text-close">'+this.text.help.close+'</span><br/>&nbsp;<span id="lightbox-overlay-text-interact">'+this.text.help.interact+'</span></p>':'')+'</div></div><div id="lightbox"><div id="lightbox-imageBox"><div id="lightbox-imageContainer"><img id="lightbox-image" /><div id="lightbox-nav"><a href="#" id="lightbox-nav-btnPrev"></a><a href="#" id="lightbox-nav-btnNext"></a></div><div id="lightbox-loading"><a href="#" id="lightbox-loading-link"><img src="' + this.files.images.loading + '" /></a></div></div></div><div id="lightbox-infoBox"><div id="lightbox-infoContainer"><div id="lightbox-infoHeader"><span id="lightbox-caption">'+(this.download_link ? '<a href="#" title="' + this.text.download + '" id="lightbox-caption-title"></a>' : '<span id="lightbox-caption-title"></span>')+'<span id="lightbox-caption-seperator"></span><span id="lightbox-caption-description"></span></span></div><div id="lightbox-infoFooter"><span id="lightbox-currentNumber"></span><span id="lightbox-close"><a href="#" id="lightbox-close-button" title="'+this.text.closeInfo+'">' + this.text.close + '</a></span></div><div id="lightbox-infoContainer-clear"></div></div></div></div>');
			
			// Update Boxes - for some crazy reason this has to be before the hide in safari and konqueror
			this.resizeBoxes();
			this.repositionBoxes();
			
			// Hide
			J('#lightbox,#lightbox-overlay,#lightbox-overlay-text-interact').hide();
			
			// -------------------
			// Browser specifics
			
			// Handle IE6
			if ( this.ie6 && this.ie6_support )
			{	// Support IE6
				// IE6 does not support fixed positioning so absolute it
				// ^ This is okay as we disable scrolling
				J('#lightbox-overlay').css({
					position:	'absolute',
					top:		'0px',
					left:		'0px'
				});
			}
			
			// -------------------
			// Preload Images
			
			// Cycle and preload
			J.each(this.files.images, function()
			{	// Proload the image
				var preloader = new Image();
				preloader.onload = function() {
					preloader.onload = null;
					preloader = null;
				};	preloader.src = this;
			});
			
			// -------------------
			// Apply events
			
			// If the window resizes, act appropriatly
			J(window).unbind('resize').resize(function ()
			{	// The window has been resized
				J.Lightbox.resizeBoxes('resized');
			});
			
			// If the window scrolls, act appropriatly
			if ( this.scroll === 'follow' )
			{	// We want to
				J(window).scroll(function ()
				{	// The window has scrolled
					J.Lightbox.repositionBoxes();
				});
			}
			
			// Prev
			J('#lightbox-nav-btnPrev').unbind().hover(function() { // over
				J(this).css({ 'background' : 'url(' + J.Lightbox.files.images.prev + ') left 45% no-repeat' });
			},function() { // out
				J(this).css({ 'background' : 'transparent url(' + J.Lightbox.files.images.blank + ') no-repeat' });
			}).click(function() {
				J.Lightbox.showImage(J.Lightbox.images.prev());
				return false;
			});
					
			// Next
			J('#lightbox-nav-btnNext').unbind().hover(function() { // over
				J(this).css({ 'background' : 'url(' + J.Lightbox.files.images.next + ') right 45% no-repeat' });
			},function() { // out
				J(this).css({ 'background' : 'transparent url(' + J.Lightbox.files.images.blank + ') no-repeat' });
			}).click(function() {
				J.Lightbox.showImage(J.Lightbox.images.next());
				return false;
			});
			
			// Help
			if ( this.show_linkback )
			{	// Linkback exists so add handler
				J('#lightbox-overlay-text-about a').click(function(){window.open(J.Lightbox.text.about.link); return false;});
			}
			J('#lightbox-overlay-text-close').unbind().hover(
				function(){
					J('#lightbox-overlay-text-interact').fadeIn();
				},
				function(){
					J('#lightbox-overlay-text-interact').fadeOut();
				}
			);
			
			// Image link
			J('#lightbox-caption-title').click(function(){window.open(J(this).attr('href')); return false;});
			
			// Assign close clicks
			J('#lightbox-overlay, #lightbox, #lightbox-loading-link, #lightbox-btnClose').unbind().click(function() {
				J.Lightbox.finish();
				return false;	
			});
			
			// -------------------
			// Finish Up
			
			// Relify
			if ( this.auto_relify )
			{	// We want to relify, no the user
				this.relify();
			}
			
			// All good
			return true;
		},
		
		relify: function ( )
		{	// Create event
		
			//
			var groups = {};
			var groups_n = 0;
			var orig_rel = this.rel;
			// Create the groups
			J.each(J('[rel*='+orig_rel+']'), function(index, obj){
				// Get the group
				var rel = J(obj).attr('rel');
				// Are we really a group
				if ( rel === orig_rel )
				{	// We aren't
					rel = groups_n; // we are individual
				}
				// Does the group exist
				if ( typeof groups[rel] === 'undefined' )
				{	// Make the group
					groups[rel] = [];
					groups_n++;
				}
				// Append the image
				groups[rel].push(obj);
			});
			// Lightbox groups
			J.each(groups, function(index, group){
				J(group).lightbox();
			});
			// Done
			return true;
		},
		
		init: function ( image, images )
		{	// Init a batch of lightboxes
			
			// Establish images
			if ( typeof images === 'undefined' )
			{
				images = image;
				image = 0;
			}
			
			// Clear
			this.images.clear();
			
			// Add images
			if ( !this.images.add(images) )
			{	return false;	}
			
			// Do we need to bother
			if ( this.images.empty() )
			{	// No images
				J.console.warn('WARNING', 'Lightbox started, but no images: ', image, images);
				return false;
			}
			
			// Set active
			if ( !this.images.active(image) )
			{	return false;	}
			
			// Done
			return true;
		},
		
		start: function ( )
		{	// Display the lightbox
				
			// We are alive
			this.visible = true;
			
			// Adjust scrolling
			if ( this.scroll === 'disable' )
			{	// 
				J(document.body).css('overflow', 'hidden');
			}
			
			// Fix attention seekers
			J('embed, object, select').css('visibility', 'hidden');//.hide(); - don't use this, give it a go, find out why!
			
			// Resize the boxes appropriatly
			this.resizeBoxes('general');
			
			// Reposition the Boxes
			this.repositionBoxes({'speed':0});
			
			// Hide things
			J('#lightbox-infoFooter').hide(); // we hide this here because it makes the display smoother
			J('#lightbox-image,#lightbox-nav,#lightbox-nav-btnPrev,#lightbox-nav-btnNext,#lightbox-infoBox').hide();
					
			// Display the boxes
			J('#lightbox-overlay').css('opacity',this.opacity).fadeIn(400, function(){
				// Show the lightbox
				J('#lightbox').fadeIn(300);
				
				// Display first image
				if ( !J.Lightbox.showImage(J.Lightbox.images.active()) )
				{	J.Lightbox.finish();	return false;	}
			});
			
			// All done
			return true;
		},
		
		finish: function ( )
		{	// Get rid of lightbox
		
			// Hide lightbox
			J('#lightbox').hide();
			J('#lightbox-overlay').fadeOut(function() { J('#lightbox-overlay').hide(); });
			
			// Fix attention seekers
			J('embed, object, select').css({ 'visibility' : 'visible' });//.show();
			
			// Kill active image
			this.images.active(false);
			
			// Adjust scrolling
			if ( this.scroll === 'disable' )
			{	// 
				J(document.body).css('overflow', 'visible');
			}
			
			// We are dead
			this.visible = false;
			
		},
		
		resizeBoxes: function ( type )
		{	// Resize the boxes
			// Used on transition or window resize
			
			// Resize Overlay
			if ( type !== 'transition' )
			{	// We don't care for transition
				var Jbody = J(this.ie6 ? document.body : document);
				J('#lightbox-overlay').css({
					width:		Jbody.width(),
					height:		Jbody.height()
				});
				delete Jbody;
			}
			
			// Handle cases
			switch ( type )
			{
				case 'general': // general resize (start of lightbox)
					return true;
					break;
				case 'resized': // window was resized
					if ( this.auto_resize === false )
					{	// Stop
						// Reposition
						this.repositionBoxes({'nHeight':nHeight, 'speed':this.speed});
						return true;
					}
				case 'transition': // transition between images
				default: // unknown
					break;
			}
			
			// Get image
			var image = this.images.active();
			if ( !image || !image.width || !this.visible )
			{	// No image or no visible lightbox, so we don't care
				//J.console.warn('A resize occured while no image or no lightbox...');
				return false;
			}
			
			// Resize image box
			// i:image, w:window, b:box, c:current, n:new, d:difference
			
			// Get image dimensions
			var iWidth  = image.width;
			var iHeight = image.height;
			
			// Get window dimensions
			var wWidth  = J(window).width();
			var wHeight = J(window).height();
			
			// Check if we are in size
			// Lightbox can take up 4/5 of size
			if ( this.auto_resize == false )
			{	// We want to auto resize
				var maxWidth  = Math.floor(wWidth*(4/5));
				var maxHeight = Math.floor(wHeight*(4/5));
				var resizeRatio;
				while ( iWidth > maxWidth || iHeight > maxHeight )
				{	// We need to resize
					if ( iWidth > maxWidth )
					{	// Resize width, then height proportionally
						resizeRatio = maxWidth/iWidth;
						iWidth = maxWidth;
						iHeight = Math.floor(iHeight*resizeRatio);
					}
					if ( iHeight > maxHeight )
					{	// Resize height, then width proportionally
						resizeRatio = maxHeight/iHeight;
						iHeight = maxHeight;
						iWidth = Math.floor(iWidth*resizeRatio);
					}
				}
			}
			
			// Get current width and height
			var cWidth  = J('#lightbox-imageBox').width();
			var cHeight = J('#lightbox-imageBox').height();
	
			// Get the width and height of the selected image plus the padding
			// padding*2 for both sides (left+right || top+bottom)
			var nWidth	= (iWidth  + (this.padding * 2));
			var nHeight	= (iHeight + (this.padding * 2));
			
			// Diferences
			var dWidth  = cWidth  - nWidth;
			var dHeight = cHeight - nHeight;
			
			// Set the overlay buttons height and the infobox width
			// Other dimensions specified by CSS
			J('#lightbox-nav-btnPrev,#lightbox-nav-btnNext').css('height', nHeight); 
			J('#lightbox-infoBox').css('width', nWidth);
			
			// Handle final action
			if ( type === 'transition' )
			{	// We are transition
				// Do we need to wait? (just a nice effect to counter the other
				if ( dWidth === 0 && dHeight === 0 )
				{	// We are the same size
					this.pause(this.speed/3);
					this.showImage(null, 3);
				}
				else
				{	// We are not the same size
					// Animate
					J('#lightbox-image').width(iWidth).height(iHeight);
					J('#lightbox-imageBox').animate({width: nWidth, height: nHeight}, this.speed, function ( ) { J.Lightbox.showImage(null, 3); } );
				}
			}
			else
			{	// We are a resize
				// Animate Lightbox
				J('#lightbox-image').animate({width:iWidth, height:iHeight}, this.speed);
				J('#lightbox-imageBox').animate({width: nWidth, height: nHeight}, this.speed);
			}
			
			// Reposition
			this.repositionBoxes({'nHeight':nHeight, 'speed':this.speed});
			
			// Done
			return true;
		},
		
		repositioning:			false,	// are we currently repositioning
		reposition_failsafe:	false,	// failsafe
		repositionBoxes: function ( options )
		{
			// Prepare
			if ( this.repositioning )
			{	// Already here
				this.reposition_failsafe = true;
				return null;
			}
			this.repositioning = true;
			
			// Options
			options = J.extend({}, options);
			options.callback = options.callback || null;
			options.speed = options.speed || 'slow';
			
			// Get page scroll
			var pageScroll = this.getPageScroll();
			
			// Figure it out
			// alert(J(window).height()+"\n"+J(document.body).height()+"\n"+J(document).height());
			// var nHeight = options.nHeight || parseInt(J('#lightbox').height(),10) || J(document).height()/3;
			var nHeight = options.nHeight || parseInt(J('#lightbox').height(),10);
			
			// Display lightbox in center
			// var nTop = pageScroll.yScroll + (J(document.body).height() /*frame height*/ - nHeight) / 2.5;
			var nTop = pageScroll.yScroll + (J(window).height() /*frame height*/ - nHeight) / 2.5;
			var nLeft = pageScroll.xScroll;
			
			// Animate
			var css = {
				left: nLeft,
				top: nTop
			};
			if (options.speed) {
				J('#lightbox').animate(css, 'slow', function(){
					if ( J.Lightbox.reposition_failsafe )
					{	// Fire again
						J.Lightbox.repositioning = J.Lightbox.reposition_failsafe = false;
						J.Lightbox.repositionBoxes(options);
					}
					else
					{	// Done
						J.Lightbox.repositioning = false;
						if ( options.callback )
						{	// Call the user callback
							options.callback();
						}
					}
				});
			}
			else
			{
				J('#lightbox').css(css);
				if ( this.reposition_failsafe )
				{	// Fire again
					this.repositioning = this.reposition_failsafe = false;
					this.repositionBoxes(options);
				}
				else
				{	// Done
					this.repositioning = false;
				}
			}
			
			// Done
			return true;
		},
		
		visible: false,
		showImage: function ( image, step )
		{
			// Establish image
			image = this.images.get(image);
			if ( !image ) { return image; }
			
			// Default step
			step = step || 1;
			
			// Split up below for jsLint compliance
			var skipped_step_1 = step > 1 && this.images.active().src !== image.src;
			var skipped_step_2 = step > 2 && J('#lightbox-image').attr('src') !== image.src;
			if ( skipped_step_1 || skipped_step_2 )
			{	// Force step 1
				J.console.info('We wanted to skip a few steps: ', image, step, skipped_step_1, skipped_step_2);
				step = 1;
			}
			
			// What do we need to do
			switch ( step )
			{
				// ---------------------------------
				// We need to preload
				case 1:
				
					// Disable keyboard nav
					this.KeyboardNav_Disable();
					
					// Show the loading image
					J('#lightbox-loading').show();
					
					// Hide things
					J('#lightbox-image,#lightbox-nav,#lightbox-nav-btnPrev,#lightbox-nav-btnNext,#lightbox-infoBox').hide();
					
					// Remove show info events
					J('#lightbox-imageBox').unbind();
					// ^ Why? Because otherwise when the image is changing, the info pops out, not good!
					
					// Make the image the active image
					if ( !this.images.active(image) ) { return false; }
					
					// Check if we need to preload
					if ( image.width && image.height )
					{	// We don't
						// Continue to next step
						this.showImage(null, 2);
					}
					else
					{	// We do
						// Create preloader
						var preloader = new Image();
						// Set callback
						preloader.onload = function()
						{	// We have preloaded the image
							// Update image with our new info
							image.width  = preloader.width;
							image.height = preloader.height;
							// Continue to next step
							J.Lightbox.showImage(null, 2);
							// Kill preloader
							preloader.onload = null;
							preloader = null;
						};
						// Start preload
						preloader.src = image.src;
					}
					
					// Done
					break;
				
				
				// ---------------------------------
				// Resize the container
				case 2:
					
					// Apply image changes
					J('#lightbox-image').attr('src', image.src);
					
					// Set container border (Moved here for Konqueror fix - Credits to Blueyed)
					if ( typeof this.padding === 'undefined' || this.padding === null || isNaN(this.padding) )
					{	// Autodetect
						this.padding = parseInt(J('#lightbox-imageContainer').css('padding-left'), 10) || parseInt(J('#lightbox-imageContainer').css('padding'), 10) || 0;
					}
					
					// Use colorBlend?
					if ( this.colorBlend )
					{	// We have colorBlend
						// Background
						J('#lightbox-overlay').animate({'backgroundColor':image.color}, this.speed*2);
						// Border
						J('#lightbox-imageBox').css('borderColor', image.color);
					}
					
					// Resize boxes
					this.resizeBoxes('transition');
					// ^ contains callback to next step
					
					// Done
					break;
				
				
				// ---------------------------------
				// Display the image
				case 3:
					
					// Hide loading
					J('#lightbox-loading').hide();
					
					// Animate image
					J('#lightbox-image').fadeIn(this.speed*1.5, function() {J.Lightbox.showImage(null, 4); });
					
					// Start the proloading of other images
					this.preloadNeighbours();
					
					// Fire custom handler show
					if ( this.handlers.show !== null )
					{	// Fire it
						this.handlers.show(image);
					}
					
					// Done
					break;
				
				
				// ---------------------------------
				// Set image info / Set navigation
				case 4:
					
					// ---------------------------------
					// Set image info
					
					// Hide and set image info
					var Jtitle = J('#lightbox-caption-title').html(image.title || 'Untitled');
					if ( this.download_link )
					{	Jtitle.attr('href', this.download_link ? image.src : '');	}
					delete Jtitle;
					J('#lightbox-caption-seperator').html(image.description ? ': ' : '');
					J('#lightbox-caption-description').html(image.description || '&nbsp;');
					
					// If we have a set, display image position
					if ( this.images.size() > 1 )
					{	// Display
						J('#lightbox-currentNumber').html(this.text.image + '&nbsp;' + ( image.index + 1 ) + '&nbsp;' + this.text.of + '&nbsp;' + this.images.size());
					} else
					{	// Empty
						J('#lightbox-currentNumber').html('&nbsp;');
					}
					
					// ---------------------------------
					// Info events
					
					// Apply event
					J('#lightbox-imageBox').unbind('mouseover').mouseover(function(){
						J('#lightbox-infoBox:not(:visible)').stop().slideDown('fast');
					});
					
					// Apply event
					J('#lightbox-infoBox').unbind('mouseover').mouseover(function(){
						J('#lightbox-infoFooter:not(:visible)').stop().slideDown('fast');
					});
					
					// Forced show?
					if ( this.show_extended_info === true )
					{	// Force show
						J('#lightbox-imageBox').trigger('mouseover');
						J('#lightbox-infoBox').trigger('mouseover');
					}
					else if ( this.show_info === true )
					{	// Force show
						J('#lightbox-imageBox').trigger('mouseover');
					}
					
					// ---------------------------------
					// Set navigation
		
					// Instead to define this configuration in CSS file, we define here. And it's need to IE. Just.
					J('#lightbox-nav-btnPrev, #lightbox-nav-btnNext').css({ 'background' : 'transparent url(' + this.files.images.blank + ') no-repeat' });
					
					// If not first, show previous button
					if ( !this.images.first(image) ) {
						// Not first, show button
						J('#lightbox-nav-btnPrev').show();
					}
					
					// If not last, show next button
					if ( !this.images.last(image) ) {
						// Not first, show button
						J('#lightbox-nav-btnNext').show();
					}
					
					// Make navigation active / show it
					J('#lightbox-nav').show();
					
					// Enable keyboard navigation
					this.KeyboardNav_Enable();
					
					// Done
					break;
					
					
				// ---------------------------------
				// Error handling
				default:
					J.console.error('Don\'t know what to do: ', image, step);
					return this.showImage(image, 1);
					// break;
				
			}
			
			// All done
			return true;
		},
		
		preloadNeighbours: function ( )
		{	// Preload all neighbour images
			
			// Do we need to do this?
			if ( this.images.single() || this.images.empty() )
			{	return true;	}
			
			// Get active image
			var image = this.images.active();
			if ( !image ) { return image; }
			
			// Load previous
			var prev = this.images.prev(image);
			var objNext;
			if ( prev ) {
				objNext = new Image();
				objNext.src = prev.src;
			}
			
			// Load next
			var next = this.images.next(image);
			if ( next ) {
				objNext = new Image();
				objNext.src = next.src;
			}
		},
		
		// --------------------------------------------------
		// Things we don't really care about
		
		KeyboardNav_Enable: function ( ) {
			J(document).keydown(function(objEvent) {
				J.Lightbox.KeyboardNav_Action(objEvent);
			});
		},
		
		KeyboardNav_Disable: function ( ) {
			J(document).unbind('keydown');
		},
		
		KeyboardNav_Action: function ( objEvent ) {
			// Prepare
			objEvent = objEvent || window.event;
			
			// Get the keycode
			var keycode = objEvent.keyCode;
			var escapeKey = objEvent.DOM_VK_ESCAPE /* moz */ || 27;
			
			// Get key
			var key = String.fromCharCode(keycode).toLowerCase();
			
			// Close?
			if ( key === this.keys.close || keycode === escapeKey )
			{	return J.Lightbox.finish();		}
			
			// Prev?
			if ( key === this.keys.prev || keycode === 37 )
			{	// We want previous
				return J.Lightbox.showImage(J.Lightbox.images.prev());
			}
			
			// Next?
			if ( key === this.keys.next || keycode === 39 )
			{	// We want next
				return J.Lightbox.showImage(J.Lightbox.images.next());
			}
			
			// Unknown
			return true;
		},
		
		getPageScroll: function ( ) {
			var xScroll, yScroll;
			if (self.pageYOffset)
			{	// Some browser
				yScroll = self.pageYOffset;
				xScroll = self.pageXOffset;
			} else if (document.documentElement && document.documentElement.scrollTop)
			{	// Explorer 6 Strict
				yScroll = document.documentElement.scrollTop;
				xScroll = document.documentElement.scrollLeft;
			} else if (document.body)
			{	// All other browsers
				yScroll = document.body.scrollTop;
				xScroll = document.body.scrollLeft;	
			}
			var arrayPageScroll = {'xScroll':xScroll,'yScroll':yScroll};
			return arrayPageScroll;
		},
		
		pause: function ( ms ) {
			var date = new Date();
			var curDate = null;
			do { curDate = new Date(); }
			while ( curDate - date < ms);
		}
	
	}); // We have finished extending/defining our LightboxClass


	// --------------------------------------------------
	// Finish up
	
	// Instantiate
	if ( typeof J.Lightbox === 'undefined' )
	{	// 
		J.Lightbox = new J.LightboxClass();
	}

// Finished definition

})(jQuery); // We are done with our plugin, so lets call it with jQuery as the argument
