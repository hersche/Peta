<script type="text/javascript">
      function setPosition(pos,zoom){
        //alert(pos);
          map.setView(pos,zoom);
    }  
    var map;
    var mapController2;
    dojo.addOnLoad(function(){

    // create a map in the "map" div, set the view to a given place and zoom
        {if $startPoi}
        map = L.map('map').setView({$startPoi->position}, {$startPoi->zoom});
        {else}
		map = L.map('map').setView([51.505, -0.09], 4);
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
          
          
        /**
          OSM 'standard' style 	http://[abc].tile.openstreetmap.org/zoom/x/y.png 	0-19
          OpenCycleMap 	http://[abc].tile.opencyclemap.org/cycle/zoom/x/y.png 	0-18
          OpenCycleMap Transport (experimental) 	http://[abc].tile2.opencyclemap.org/transport/zoom/x/y.png 	0-18
          CloudMade (Web style) 	http://[abc].tile.cloudmade.com/your_CloudMade_API_key/1/256/zoom/x/y.png 	0-18
          MapQuest 	http://otile[1234].mqcdn.com/tiles/1.0.0/osm/zoom/x/y.jpg 	0-19
          MapQuest Open Aerial 	http://otile[1234].mqcdn.com/tiles/1.0.0/sat/zoom/x/y.jpg 	0-11 globally, 12+ in the U.S.
          Migurski's Terrain 	http://tile.stamen.com/terrain-background/zoom/x/y.jpg 	4-18, US-only (for now) 
          
          http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png
          http://tile.stamen.com/watercolor/{z}/{x}/{y}.jpg
          http://tile.stamen.com/toner/{z}/{x}/{y}.jpg
        **/
		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
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
                +'</td></tr><tr><td>Zoom</td><td>'+generateZoomList(map.getZoom())+'</td></tr></tr><tr><td>Type</td><td><select name="type"><option>Cyrcle</option><option>POI</option></select></td></tr><tr><td>Shared</td><td><input value="1" name="createPoiShared" type="checkbox" /></td></tr><tr><td><input type="submit" value="Create Poi" />'+'</td><td> ['+pos.lat+','+pos.lng+']</td></tr></table></form>') .openOn(map);
                //alert(map.getZoom());
		}

		map.on('click', onMapClick);

    });
</script>

<div id="map" style="width: 100%; height: 500px;"></div>

<h2>Your Pois</h2>
<p>Just click into the map to create a POI. Call one "start" to set your start position.</p>
{if $poiList}
{foreach from=$poiList item=poi}

<form action="plugin.php?plugin={$pluginId}" method="post">
    <input type="text" name="editPoiName" value="{$poi->name}" />
    <input type="hidden" name="editPoiId" value="{$poi->id}" />
    <input type="text" readonly name="editPoiPosition" value="{$poi->position}" />
    {if $poi->shared === "1"}
    <input value="1" name="editPoiShared" type="checkbox" checked />
    {else}
    <input value="1" name="editPoiShared" type="checkbox" />
    {/if}
<select name="editZoom">
                            {html_options values=range(1,18) output=range(1,18) selected=$poi->zoom}
                        </select>
    <input type="submit" value="Edit Poi" /></form>
<button onclick="setPosition({$poi->position},{$poi->zoom});">Go to point</button> 
{if $userid==$poi->ownerid}
 		<a href='plugin.php?plugin={$pluginId}&amp;delPoi={$poi->id}' class="button delete">Delete</a>
{/if}
 {/foreach}

{/if}
