<!DOCTYPE>
<html>
<head>
	<title>COLOCVIU</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body style="background-image:url('https://wallpaperaccess.com/full/2098177.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">

<nav class="navbar sticky-top navbar-dark bg-dark">
	<a class="navbar-brand" href="ex5.html"><img src="arrow_back.png"></a>
    <a class="navbar-brand" href="proiect.html"><img src="home.png"></a>
</nav>

<div class="container" style="text-align: center; opacity: 0.55; background-color: #708f75; margin-top: 50px; margin-left: 80px; margin-right: 30px; padding-top: 30px; padding-bottom: 30px;">

	<?php
		$user = 'admin';
		$pass = 'student123';
		$host = 'localhost';
		$db_name = 'colocviu';
		
		$dsn= new mysqli( $host, $user, $pass, $db_name);
		
		if ($dsn->connect_error)
		{
			die('Connection error:'. $dsn->connect_error);
		}
		
		$query = "SELECT numep FROM proiecte
			WHERE oras IN
				(SELECT oras FROM furnizori
				WHERE idf = 'F001');";
		$result = mysqli_query($dsn, $query);
		
		if (!$result)
		{
			die('Error:'.mysqli_error($dsn));
		}

		echo "<h4>Să se găsească denumirea proiectelor situate în același oraș cu orașul furnizorului ce are idf ’F001’.</h4>";
		
		echo ' <Table class = "table">
		<tr>
			<th>#</th>
			<th>Proiecte:</th>
		</tr>'; 

		$rows = mysqli_num_rows($result);
		
		for ($i=0; $i < $rows; $i++)
		{
			echo '<tr>';
			$row = mysqli_fetch_assoc($result);
			echo '<td>'.stripslashes($i+1).'</td>';
			echo '<td>'.stripslashes($row['numep']).'</td>';
			echo '</tr>';
		}

		mysqli_close($dsn);
	?>
</div>

</body>
</html>