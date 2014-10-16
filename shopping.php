<?PHP
    include('class_lib.php');

    // We need to have 1 config object with all data in.
    $config = new config("localhost", "root", "", "ahs", "", "mysqli"); //type in your data here…
    // Now we need to have access to the db class, we uses the config object to configure the db object.
	$db = new db($config);
    // We can now open the connection to the database.
    $db->openConnection();
    // If your config details are right, we are now connected to a database, lets test the connection before we run queries.
    $are_we_online = $db->pingServer();
    // The variable $are_we_online should be true (or 1) if we are connected to the server.
    echo "Are we online: " . $are_we_online; // prints 0 or 1.
    // Let us run a query.
    $sql = $db->query("SELECT * FROM {shoplist}");
    // The variable $sql will now hold the data returned from the database, we can now work with it.
    // Does it have rows ?
    $hasRows = $db->hasRows($sql);
    echo "Does it have rows: " . $hasRows; // prints 0 or 1 (true or false).
    echo "<br />";
	// How many rows does it have.
    $countRows = $db->countRows($sql);
    echo "How many rows: " . $countRows; // returns the number of rows.
    // We can get the data from the fetch_assoc function.
   // $result = $db->fetchAssoc($sql);
   $result = $db->print_array($sql);
	print "<pre>";
//	print_r($result);
echo array_keys(current($sql));
	print "</pre>";
	
	if ($countRows > 0) { ?>
<table>
<thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys(current($sql))); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($sql as $row): array_map('htmlentities', $row); ?>
    <tr>
      <td><?php echo implode('</td><td>', $row); ?></td>
    </tr>
<?php endforeach; ?>
  <tbody>
</table>
<?php }
    // We can get the data from the fetch_array function.
    //$result = $db->fetchArray($sql);
	//print_r($result);
    //We can even print out the latest used query:
    //echo $db->lastQuery();
    // As a last thing, close the connection.
    $db->closeConnection();
?>
