<?php 

session_start();

if(isset($_SESSION['login'])){
}else
  $_SESSION['login'] = false;


$loggedin = $_SESSION['login'];

if(!$loggedin){
   header('location:http://LINK.com/');
}

?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">

@import url('https://fonts.googleapis.com/css2?family=Work+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

*{
    margin: 0;
    padding: 0;
    font-family: 'Work Sans', sans-serif;
}

html, body {
  background: #FDFDFD;
}

input{
    border: none;
    padding: 1px 7px;
    border-radius: 5px;
    width: 65px;
    background: none;
}

.width{
    width: 300px;
}

.width-180{
  width: 180PX;
}

.width-100{
  width: 100PX;
}

.button {
    color: #a19fa5;
    font-size: 17px;
    background: white;
    padding: 9px 14px;
    box-shadow: 3px 3px 30px rgb(118 96 168 / 20%);
    display: inline-block;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
    margin-bottom: 15px;
}

.button:hover {
  color: #DBD7E0;
  transform: translateY(3px);
  box-shadow: 3px 3px 30px rgba(118, 96, 168, 0.17);
}

.arrow {
  width: 13px;
  transition: transform 0.3s ease;
  float: right;
  margin-top: 9px;
}

.arrow.open {
  transform: rotate(180deg);
}

.button p {
  display: inline;
  margin-right: 75px;
}

.dropdown {
  position: relative;
  font-size: 17px;
  background: white;
  padding-top: 10px;
  padding-bottom: 10px;
  display: block;
  cursor: pointer;
  transform: scale(0.01);
  opacity: 0;
  transition: transform 0.3s ease, opacity 0.3s ease, box-shadow 0.3s ease 0.15s;
  transform-origin: center top;
  overflow: hidden;
}

.dropdown.open {
  transform: scale(1);
    opacity: 0.8;
    box-shadow: 3px 3px 30px rgb(118 96 168 / 15%);
    background: black;
    color: white !important;
    border: 1px solid #681414;
    padding: 0 13px;
}

.dropdown a {
  position: relative;
  color: #6C6185;
  text-decoration: none;
  display: block;
  padding: 12.5px 30px;
  transition: color 0.2s ease, background-color 0.2s ease, padding-left 0.2s ease;
  overflow: hidden;
}

.dropdown a.clicked {
  padding-left: 35px;
  color: #987CD9;
}

.dropdown a:hover {
  color: #987CD9;
  padding-left: 35px;
}

span {
  z-index: -1;
  top: 0;
  left: 0;
  bottom: 0;
  width: 0px;
  position: absolute;
  background: #987CD9;
  transition: width 0.4s ease;
  border-radius: 1px;
}

span.clicked {
  width: 5px;
}

.button2{
  box-shadow: 0 8px 16px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
  background-color: #4CAF50;
  border: none;
  color: white;
  padding-top: 11px;
  padding-left: 5px;
  padding-right: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  margin: 8px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s;
  transition-duration: 0.4s;
}


.btn-group .button2 {
  background-color: #4CAF50; /* Green */
  border: 1px solid green;
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  cursor: pointer;
  width: 150px;
  display: block;
}

i{
  color: #eef1f3;
}

.btn-group .button2:not(:last-child) {
  border-bottom: none; /* Prevent double borders */
}

.created_at i{
  align-self: flex-end;
  font-size: 12px;
  margin-bottom: 10px;
}

.btn-group .button2:hover {
  background-color: #3e8e41;
}

.history_tr{
  padding: 10px 0;
}

.logout_btn{
  border-radius: 25px;
  padding: 5px 6px;
}

.logout_btn:hover{
  background-color: #ab2734 !important;
}


</style>
    <title>Vehical Tracking System</title>

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 100%; transition: all 0.3s; }
        #left_menu{ z-index: 5; position: absolute; width: fit-content; padding-left: 11px; margin-top: 10px; height: 230px; }
    </style>

</head>
<body>

<div id="left_menu">
    <div style="background-color: #fff;" class="width pt-1">
        <div class="ms-1 mt-1 pb-2" style="width: fit-content;">
            <font class="fs-4 fw-bold"><a href="http://rohitkrtiwari.000webhostapp.com/logout.php" class="btn fa fa-power-off text-white bg-danger ms-1 me-1 logout_btn" style="    border-radius:25px;padding: 5px 6px;"></a>Live Vehical Tracking</font><br>
        </div>
    </div>

    <button id="fly" class="button2">RELOCATE
      <div class="container-fluid-0 mt-1 pb-1" style="font-size: 10px;">
        <div class="d-flex">
          <i class="lat_lang_title_style">Lat:</i> <input type="number" class="ms-2 m-0 p-0 text-white" name="latitude_val" disabled  id="latitude_val">
        </div>
        <div class="d-flex">
          <i class="lat_lang_title_style">Long:</i> <input type="text" class="ms-2 p-0 m-0 text-white" name="longitude_val" disabled id="longitude_val">
        </div>
      </div>
    </button>


      <div class="button mt-1 width-180"> <p>History</p> <img
      src="https://svgshare.com/i/8u6.svg" alt="" class="arrow"> </div>

      <div class="dropdown width" id="history"></div>



</div>
<script type="text/javascript">
    $(document).ready(function(){
  $(".button").click(function() {
    $(".dropdown a").removeClass("clicked");
    $(".dropdown a").children("span").removeClass("clicked");
    $(".arrow").toggleClass("open");
    $(".dropdown").toggleClass("open");
  });
  
  $(".dropdown a").click(function() {
    $(".dropdown a").removeClass("clicked");
    $(".dropdown a").children("span").removeClass("clicked");
    $(this).toggleClass("clicked");  $(this).children("span").toggleClass("clicked");
  });
});
</script>
<div id="map"></div>
<br>


<script>

    mapboxgl.accessToken = 'pk.eyJ1IjoidmVoaWNhbC10cmFja2luZyIsImEiOiJja21qYWg3d3owcDJuMnB0NDA3bXZrNHQ4In0.CwRmVs9vxK4LfGcR4qa7ag';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/vehical-tracking/ckn7qx70r11jm17o0t1oo3w53',
        zoom: 8
    });

    var popup =  new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: false
    });

    var field2;
    var field1;

    // Add zoom and rotation controls to the map.
    map.addControl(new mapboxgl.NavigationControl(), 'top-right');


    var url = 'https://api.thingspeak.com/channels/1349810/feeds.json?api_key=P8UQCWR86346KP80&results=1';
    map.on('load', function () {
        var request = new XMLHttpRequest();
        window.setInterval(function () {
            // make a GET request to parse the GeoJSON at the url
            request.open('GET', url, true);
            request.onload = function () {
                if (this.status >= 200 && this.status < 400) {
                    // retrieve the JSON from the response
                    var json = JSON.parse(this.response);

                    if( parseFloat(json.feeds[0].field2) != field2 || parseFloat(json.feeds[0].field2) != field2 )
                    {

                                            

                        field2 = parseFloat(json.feeds[0].field2);
                        field1 = parseFloat(json.feeds[0].field1);



                        var geojson = {
                            "name":"NewFeatureType",
                            "type":"FeatureCollection",
                            "features":[{
                                "type":"Feature",
                                "geometry":{
                                    "type":"Point",
                                    "coordinates":[field2, field1]
                                },
                                "properties":{
                                    'description':json.feeds[0].created_at
                                }
                            }]
                        };

                        var created_at = json.feeds[0].created_at;


                        // update the drone symbol's location on the map

                        // fly the map to the drone's current location
                        map.getSource('drone').setData(geojson);
                        console.log(geojson.features[0].geometry.coordinates);
                        map.flyTo({
                            center: geojson.features[0].geometry.coordinates,
                            speed: 0.5,
                        });
                    

                        update_fields(geojson.features[0].geometry.coordinates[0], geojson.features[0].geometry.coordinates[1]);


                        map.on("mouseenter", "drone", () => {
                            popup.setHTML(created_at)
                            .setLngLat(geojson.features[0].geometry.coordinates)
                                .addTo(map);
                            map.getCanvas().style.cursor = "pointer";
                        });
                        map.on("mouseleave", "drone", () => {
                          map.getCanvas().style.cursor = "";
                          popup.remove(); 
                        });

                    }

                }
            };
            request.send();
        }, 2000);

        map.addSource('drone', { type: 'geojson', data: url });
        map.addLayer({
            'id': 'drone',
            'type': 'symbol',
            'source': 'drone',
            'layout': {
                'icon-image': 'rocket-15',
                'icon-size': 2
            }
        });


    });

    document.getElementById('fly').addEventListener('click', function () {
      // Fly to a random location by offsetting the point -74.50, 40
      // by up to 5 degrees.
      map.flyTo({
        center: [
          field2,
          field1
        ],
        essential: true // this animation is considered essential with respect to prefers-reduced-motion
      });
      var geojson = {
          "name":"NewFeatureType",
          "type":"FeatureCollection",
          "features":[{
              "type":"Feature",
              "geometry":{
                  "type":"Point",
                  "coordinates":[field2, field1]
              },
              "properties":{
                  'description':0
              }
          }]
      };
    map.getSource('drone').setData(geojson);
    });


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        var html="";

        var pre_field1, pre_field2 = 0;

        for(var i in myObj.feeds){
          
          if( myObj.feeds[i].field2 != '' && myObj.feeds[i].field2 != 0 && myObj.feeds[i].field2 != null && myObj.feeds[i].field2 != 'null' && myObj.feeds[i].field1 != '' && myObj.feeds[i].field1 != 0 && myObj.feeds[i].field1 != null && myObj.feeds[i].field1 != 'null' )
          {

            if(myObj.feeds[i].field2 != pre_field2 && myObj.feeds[i].field2 != pre_field2)
            {
              pre_field2 = myObj.feeds[i].field2;
              pre_field1 = myObj.feeds[i].field1;

              temp= '<div class="d-flex history_tr" onclick="fly('+myObj.feeds[i].field2+', '+myObj.feeds[i].field1+')""><div class="m-0 width-100" style="font-size: 13px;">Lat: '+myObj.feeds[i].field2+' <br> Long: '+myObj.feeds[i].field1+'</div> <div class="m-0 created_at d-flex"> <i>At : '+myObj.feeds[i].created_at+' </i></div></div>';
              html = temp.concat(html);
            }
          }
        }
        console.log(html)
        $("#history").append(html);
      }
    };
    xmlhttp.open("GET", "https://api.thingspeak.com/channels/1349810/feeds.json?api_key=P8UQCWR86346KP80", true);
    xmlhttp.send();


function update_fields(lat, long){
    $("#latitude_val").val(lat);
    $("#longitude_val").val(long);
}

function fly(temp_lat, temp_long){
  map.flyTo({
    center: [
      temp_lat,
      temp_long
    ],
    essential: true // this animation is considered essential with respect to prefers-reduced-motion
  });
  var geojson = {
        "name":"NewFeatureType",
        "type":"FeatureCollection",
        "features":[{
            "type":"Feature",
            "geometry":{
                "type":"Point",
                "coordinates":[temp_lat, temp_long]
            },
            "properties":{
                'description':0
            }
        }]
    };
  map.getSource('drone').setData(geojson);
}

</script>
</body>
</html>