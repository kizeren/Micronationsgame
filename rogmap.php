<?php
include("config.php");



function dump_child_nodes($node)
{
  $output = '';
  $owner_document = $node->ownerDocument;
   
  foreach ($node->childNodes as $el){
    $output .= $owner_document->saveXML($el);
  }
  return $output;
}


// Start XML file, create parent node
$doc = new DOMDocument("1.0");  
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);

// Select all the rows in the markers table
$query = "SELECT * FROM roguenations";
$result = mysql_query($query, $db);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $doc->createElement("marker");
  $newnode = $parnode->appendChild($node);
  //$newnode->setAttribute("id", $row['member_id']);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lon']);
  $newnode->setAttribute("level", $row['level']);
  $newnode->setAttribute("rogid", $row['id']);
}

$xmlfile = $doc->saveXML();
echo $xmlfile;

?>