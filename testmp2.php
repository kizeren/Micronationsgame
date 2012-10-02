<?php /**
* Customizing your map with Phoogle Maps
* class developed by Justin Johnson <justinjohnson@system7designs.com>
*/

require_once 'phoogle.php';
include('config.php');
$map = new PhoogleMap();
$map->setAPIKey("ABQIAAAAggef3bNpDpQqbJQ9St-2uxTmLgyQXfmorlurUajGnuLXyU3nRxT2dbJ--uzaI-q9dxbXkn22l8fO7Q");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <? $map->printGoogleJS(); ?>
   </head>
  <body>
  <?
    //customization options are here
    $map->zoomLevel = 15;             //zoom in as far as we can
    $map->setWidth(1000);            //pixels
    $map->setHeight(600);           //pixels
    $map->controlType = 'large';    //show large controls on the side
    $map->showType = false;         //hide the map | sat | hybrid buttons
    

//CUSTOM INFO WINDOW DATA

$map = mysql_query("SELECT * FROM map_coords");
while($maprow = mysql_fetch_array($map))
{

  $map->addGeoPoint("$maprow[2]", "$maprow[3]");
echo "$maprow[2] $maprow[3]";
}

  $map->showMap();

  ?>
  <h3>Displayed Points:</h3>
  <h4>(displayed using a table with an id of "my_table")</h4>
  <? $map->showValidPoints("table","my_table"); ?>
  <h3>Points NOT displayed</h3>
  <h4>(dispayed using an unordered list with an id of "my_list")</h4>
  <? $map->showInvalidPoints("list","my_list"); ?>
  </body>

</html>

