<?php
require_once 'Google/Maps.php';

$map = Google_Maps::create('static');

$map->setSize('540x300');
$map->setKey('ABQIAAAAggef3bNpDpQqbJQ9St-2uxTmLgyQXfmorlurUajGnuLXyU3nRxT2dbJ--uzaI-q9dxbXkn22l8fO7Q');

$coord_1 = new Google_Maps_Coordinate('58.378700', '26.731110');
$coord_2 = new Google_Maps_Coordinate('58.379646', '26.764090');

$marker_1 = new Google_Maps_Marker($coord_1);
$marker_2 = new Google_Maps_Marker($coord_2);

$map->addMarker($marker_1);
$map->addMarker($marker_2);
$map->zoomToFit();

$zoom = Google_Maps_Control::create('zoom');
$map->addControl($zoom);
$pan = Google_Maps_Control::create('pan');
$map->addControl($pan);

$bubble_1 = new Google_Maps_Infowindow('Foo Bar');
$bubble_2 = new Google_Maps_Infowindow('Pler pop');

$bubble_1->setMarker($marker_1);
$bubble_2->setMarker($marker_2);

$map->addInfowindow($bubble_1);
$map->addInfowindow($bubble_2);

$map->setProperties($_GET);


?>
