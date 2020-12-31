<?php
$zoom = (int)$_GET['z'];
$column = (int)$_GET['x'];
$row = (int)$_GET['y'];
$db = $_GET['db'];

//Check if the file requested exsists and is in the working directory or it's subfolders
if (substr(getcwd(), 0, strlen(realpath($db))) === getcwd() && file_exists($db)) {
  try
  {
    // Open the database
	$conn = new PDO("sqlite:$db");

	// Query the tiles view and echo out the returned image
	$sql = "SELECT * FROM tiles WHERE zoom_level = :zoom AND tile_column = :column AND tile_row = :row";
	$q = $conn->prepare($sql);
	//Bind the parameters to prevent SQL injection
	$q->bindParam(":zoom", $zoom);
	$q->bindParam(":column", $column);
	$q->bindParam(":row", $row);

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
} else {
	http_response_code(404);
}
