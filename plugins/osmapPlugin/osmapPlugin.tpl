<script type="text/javascript">
    
    dojo.addOnLoad(function(){

    // create a map in the "map" div, set the view to a given place and zoom
        {if $startPoi}
        var map = L.map('map').setView({$startPoi->position}, 6);
        {else}
		var map = L.map('map').setView([51.505, -0.09], 4);
         {/if}
         

          
{literal}
         
    function generateZoomList(zoomValue) {
             var zoomList = '<select name="zoom">';
             var i = 0;
            while (i<19){
                if(zoomValue==i){
                    zoomList = zoomList +"<option selected>"+i+"</option>";
                } else{
                    zoomList = zoomList +"<option>"+i+"</option>";   
                }
                i++;
            }
        zoomList = zoomList +"</select>";
        return zoomList;
         }
          
          
          
		L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'examples.map-9ijuk24y'
		}).addTo(map);

		L.circle([51.508, -0.11], 500, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5
		}).addTo(map).bindPopup("I am a circle.");

		L.polygon([
			[51.509, -0.08],
			[51.503, -0.06],
			[51.51, -0.047]
		]).addTo(map).bindPopup("I am a polygon.");

          {/literal}
{if $poiList}
{foreach from=$poiList item=poi}
 		L.marker({$poi->position}).addTo(map)
			.bindPopup("{$poi->name} <br /><a href='plugin.php?plugin={$pluginId}&amp;delPoi={$poi->id}' class='button delete'>Delete</a>");
 
 {/foreach}

{/if}
		var popup = L.popup();
		function onMapClick(e) {
            var pos = L.latLng(e.latlng);
			popup
				.setLatLng(e.latlng)
				.setContent('<form action="plugin.php?plugin={$pluginId}" method="post"><table><tr><td>Name</td>'
                +'<td><input type="text" name="createPoiName" /><input type="hidden" name="createPoiPosition" value="['+pos.lat+','+pos.lng+']" />'
                +'</td></tr><tr><td>Zoom</td><td>'+generateZoomList(map.getZoom())+'</td></tr><tr><td><input type="submit" value="Create Poi" />'
                +'</td><td> ['+pos.lat+','+pos.lng+']</td></tr></table></form>') 
				.openOn(map);
                //alert(map.getZoom());
		}

		map.on('click', onMapClick);

    });
</script>

<div id="map" style="width: 600px; height: 400px"></div>

<h2>Your Pois</h2>
<p>Just click into the map to create a POI. Call one "start" to set your start position.</p>
{if $poiList}
{foreach from=$poiList item=poi}
<form action="plugin.php?plugin={$pluginId}" method="post">
    <input type="text" name="editPoiName" value="{$poi->name}" />
    <input type="hidden" name="editPoiId" value="{$poi->id}" />
    <input type="text" readonly name="editPoiPosition" value="{$poi->position}" />
    <input type="submit" value="Edit Poi" /></form>
 		<a href='plugin.php?plugin={$pluginId}&amp;delPoi={$poi->id}' class="button delete">Delete</a>
 
 {/foreach}

{/if}
