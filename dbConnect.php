<!-- <?php

	// DEFINE ('DB_USER', 'root');
	// DEFINE ('DB_PASSWORD', '');
	// DEFINE ('DB_HOST', 'localhost');
	// DEFINE ('DB_NAME', 'hr-gmrc');

	// $dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

	// mysqli_set_charset($dbcon, 'utf8');
?> -->

<?php

	DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'hr-gmrc');

		try {
            $dbcon = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);  
            $dbcon->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $dbcon->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8  

        } catch(\Exeption $e) {
            die( $e->getMessage() );
            return;
        }

 ?>