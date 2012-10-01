<?php
$zoom = $_GET['z'];
$column = $_GET['x'];
$row = $_GET['y'];
$db = $_GET['db'];
  try
  {
    // Open the database
    $conn = new PDO("sqlite:$db");

    // Query the tiles view and echo out the returned image
	$sql = "SELECT * FROM tiles WHERE zoom_level = $zoom AND tile_column = $column AND tile_row = $row";
	$q = $conn->prepare($sql);
	$q->execute();

	$q->bindColumn(1, $zoom_level);
	$q->bindColumn(2, $tile_column);
	$q->bindColumn(3, $tile_row);
	$q->bindColumn(4, $tile_data, PDO::PARAM_LOB);

	while($q->fetch())
	{
	header("Content-Type: image/png");
	echo $tile_data;
	}
  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }
?>