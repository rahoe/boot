<?php

	$name = isset($_GET['name']) ? $_GET['name'] : false;

?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Testform</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="./style.css" />
</head>
<body>

<?php

	// Name sent in
	if ($name) {
		echo '<p>Bedankt ' . htmlentities($name). ' voor het verzenden van het contactformulier. We behandelen dit zo snel mogelijk!</p>';
	}

	// Nothing sent in
	else {
		echo '<p>Je kan geen leeg formulier indienen</p>';
	}

?>

	<div id="debug">

<?php

	/**
	 * Helper Functions
	 * ========================
	 */

		/**
		 * Dumps a variable
		 * @param mixed $var
		 * @return void
		 */
		function dump($var) {
			echo '<pre>';
			var_dump($var);
			echo '</pre>';
		}


	/**
	 * Main Program Code
	 * ========================
	 */

		// dump $_GET
		dump($_GET);

?>

	</div>

</body>
</html>
