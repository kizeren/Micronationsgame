<?php  
include("config.php");

  include("$directory/includes/config/auth.php");
  include("$directory/includes/misc/include.php");

       $id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<?php

$id = mysql_real_escape_string($_SESSION['SESS_MEMBER_ID']);

echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<title>National Information</title>";
echo "<link href=\"loginmodule.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "</head>";
echo "<body>";
echo "<div id=\"banner\">";
echo "<h1>Welcome ";
echo $_SESSION['SESS_LOGIN'];
echo " to $game_name <img src=\"http://mcbride.homelinux.net/~nations/flags/beta_icon.gif\"></h1>";
include("$directory/includes/misc/clock.php"); 
echo "</div>";
include("$directory/includes/menus/newmenu.php");
echo "<div id=\"main\">";
include("$directory/includes/misc/resource.php");



$mapcoords_sql = mysql_query("SELECT * FROM map_coords WHERE member_id ='$id'",$db);
while($mapcoords = mysql_fetch_array($mapcoords_sql))
{
    

?>

<center>
    <script 
src="https://maps.google.com/maps/api/js?key=api&v=2&key=AIzaSyCK8LWPZXdV6k1jLZep-ihRUXYUWL6bLp0" 
       type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var iconBlue = new GIcon(); 
    iconBlue.image = 'http://www.midwayhotels.com/extension/neteext/design/BrookfieldBestWestern/images/gmap/mm_20_purple.png';
    iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconBlue.iconSize = new GSize(12, 20);
    iconBlue.shadowSize = new GSize(22, 20);
    iconBlue.iconAnchor = new GPoint(6, 20);
    iconBlue.infoWindowAnchor = new GPoint(5, 1);

    var iconRed = new GIcon(); 
    iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
    iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconRed.iconSize = new GSize(12, 20);
    iconRed.shadowSize = new GSize(22, 20);
    iconRed.iconAnchor = new GPoint(6, 20);
    iconRed.infoWindowAnchor = new GPoint(5, 1);

    var customIcons = [];
    customIcons["rogue"] = iconBlue;
    customIcons["bar"] = iconRed;

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng( <?php echo $mapcoords[2]; ?>, <?php echo $mapcoords[3]; ?>), 5);
        

        // Change this depending on the name of your PHP file
        GDownloadUrl("<?php echo "phpsqlajax_genxml.php"; ?>", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var id = markers[i].getAttribute("id");
            var type = markers[i].getAttribute("type");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point, name, id, type);
            map.addOverlay(marker);
          }
        });
                GDownloadUrl("<?php echo "rogmap.php"; ?>", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var rogid = markers[i].getAttribute("rogid");
            var level = markers[i].getAttribute("level");
            var type = 'rogue';
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarkerRogue(point, name, rogid, level, type);
            map.addOverlay(marker);
          }
        });
      }
    }
//Players
    function createMarker(point, name, id, type) {
      var marker = new GMarker(point, customIcons[type]);
      var html = "<b>" + name + "</b> <br/><a href=\"./public_profile.php?id=" + id + "\"> View Profile</a> | <a href =\"battle.php?name=" + name + "\">Attack</a>";
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }
    //Rogue Nations
            function createMarkerRogue(point, name, rogid, level, type) {
      var marker = new GMarker(point, customIcons[type]);
      var html = "<b>" + name + "</b>(" + level + ")<br/> Rogue Nation | <a href =\"battle.php?rogue=" + name + "&rogid=" + rogid + "\">Attack</a>" ;
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }
  </script>
</center>
  </head>

  <body onload="load()" onunload="GUnload()">
    <div id="map" style="width: 800px; height: 400px"></div>
 <?php 
} //End cener of map for user.
 
  include("$directory/includes/misc/online.php");
  echo "</div>";
include("$directory/includes/misc/count.php");
include("$directory/includes/misc/footer.php");
?>
  </body>
  
</html>

