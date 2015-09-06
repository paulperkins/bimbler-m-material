/**
 * Bimbler Mobile
 *
 * @author    Paul Perkins <paul@paulperkins.net>
 * @license   GPL-2.0+
 * @link      http://bimblers.com/plugins
 * @copyright 2015 Paul Perkins
 */

jQuery(document).ready(function ($) {
		
	var event_maps = {};
	var event_markers = {};
	var event_rwgps_maps = {};
	
	function setMap(event_address, map_div, event_id) {
    	var myOptions = {
    	    zoom: 17,
    	    center: event_address,
    	    mapTypeId: google.maps.MapTypeId.ROADMAP
    	};

    	var map = new google.maps.Map(document.getElementById(map_div), myOptions);
      
    	var marker = new google.maps.Marker(
    		{
    			map: map,
    			position: event_address
    		}
    	);
    	
    	// Store the map object in a global associative array to enable re-sizing later.
    	event_maps[event_id] = map;
    	event_markers[event_id] = marker;

    }

    window.renderVenueMap = function (address, map_div, event_id) {

    	var address = address || null;
    	
    	var geocoder= new google.maps.Geocoder();
    	
    	geocoder.geocode( 
    		{ 'address': address }, 
    		function(results, status) {
    			if (status == google.maps.GeocoderStatus.OK) {
    				setMap(results[0].geometry.location, map_div, event_id);
    			}
    		}
    	);
    }

    window.centreVenueMap = function (map, marker) {

    	map.setCenter(marker.getPosition());
    	
    }
	
	
	window.showVenueMap = function (target) {
	
		var event_id = target.getAttribute ('data-bimbler-event-id');
		//var event_id = target.attr ('data-bimbler-event-id');
		
		//var gmap_id = 'tribe-events-gmap-' + event_id;
		
		var gmap_id = target.getAttribute('id');
		
		//console.log ('Rendering venue map for event ' + event_id);
		
		//var gmap = document.getElementById(gmap_id);
		//var gmap = $('#' + gmap_id)[0];
		
		var gmap = target;
		
		if (gmap) {
		
			var venue_address = decodeURIComponent(gmap.getAttribute('data-venue-address'));
			
			// Create the map if it doesn't already exist.
			if (!event_maps[event_id]) {
				
				renderVenueMap('"' + venue_address + '"', gmap_id, event_id);
				
			}
		}
	
		// Resize and re-centre the map.
		if (event_maps[event_id]) {
	
			google.maps.event.trigger(event_maps[event_id], 'resize');
			
			centreVenueMap (event_maps[event_id], event_markers[event_id]);
		}
	}
	
	//showVenueMap ($(this)[0].activeElement);
	
	showVenueMap (document.getElementById('bimbler-venue-map'));


});

