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
        
        /*
        $query = "SELECT numec FROM componente JOIN livrari USING(idc) JOIN proiecte USING(idp)
            WHERE proiecte.oras = 'Bistrita'
            AND cantitate <= ALL(
                SELECT cantitate FROM proiecte JOIN livrari USING(idp)
                WHERE oras = 'Bistrita');";
        $result = mysqli_query($dsn, $query);
        
        if (!$result)
        {
            die('Error:'.mysqli_error($dsn));
        }

        echo ' <Table class="table">
        <tr>
            <th>#</th>
            <th>Componenta</th>
        </tr>'; 

        $rows = mysqli_num_rows($result);
        
        for ($i=0; $i < $rows; $i++)
        {
            echo '<tr>';
            $row = mysqli_fetch_assoc($result);
            echo '<td>'.stripslashes($i+1).'</td>';
            echo '<td>'.stripslashes($row['numec']).'</td>';
            echo '</tr>';
        }*/

        $oras = $_POST['oras'];
        $oras = trim($oras);

        echo "<h5>Să se găsească numele componentei livrată în cantitatea cea mai mică pentru proiecte situate în orașul $oras</h5>";

        $query = "CALL getCompOras('".$oras."')";


        
        $result = mysqli_query($dsn, $query);

        if (!$result)
        {
            die('Error:'.mysqli_error($dsn));
        }
        $row = mysqli_fetch_assoc($result);

        echo '<h3>Componenta livrata in cantitatea cea mai mica: '.$row['numec'].'</h3>';
        ///echo 'mysqli_query('.$dsn.',call getCompOras('.$oras.')';

        mysqli_close($dsn);
    ?>
</div>

</body>
</html>