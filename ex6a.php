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
    <a class="navbar-brand" href="ex6.html"><img src="arrow_back.png"></a>
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
        
        /// proiecte

        $query = "SELECT oras, COUNT(idp)
            FROM proiecte
            GROUP BY oras;";
        $result = mysqli_query($dsn, $query);
        
        if (!$result)
        {
            die('Error:'.mysqli_error($dsn));
        }

        echo "<h4>Să se găsească câte proiecte, câte componente și câți furnizori există pentru fiecare oraș (oraș, număr_proiecte, număr_componente, număr_furnizori).</h4>";
        
        echo "<h3>Proiecte</h3>";
       
        echo ' <Table class="table">
        <tr>
            <th>#</th>
            <th>Oras</th>
            <th>Nr Proiecte:</th>
        </tr>'; 

        $rows = mysqli_num_rows($result);
        
        for ($i=0; $i < $rows; $i++)
        {
            echo '<tr>';
            $row = mysqli_fetch_assoc($result);
            echo '<th>'.stripslashes($i+1).'</th>';
            echo '<td>'.stripslashes($row['oras']).'</td>';
            echo '<td>'.stripslashes($row['COUNT(idp)']).'</td>';
            echo '</tr>';
        }

        /// componente

        $query = "SELECT oras, COUNT(idc)
        FROM componente
        GROUP BY oras;";

        $result = mysqli_query($dsn, $query);
        
        if (!$result)
        {
            die('Error:'.mysqli_error($dsn));
        }



        echo ' <Table class="table">
        <tr>
            <th>#</th>
            <th>Oras</th>
            <th>Nr Componente:</th>
        </tr>'; 

        $rows = mysqli_num_rows($result);
        
        for ($i=0; $i < $rows; $i++)
        {
            echo '<tr>';
            $row = mysqli_fetch_assoc($result);
            echo '<th>'.stripslashes($i+1).'</th>';
            echo '<td>'.stripslashes($row['oras']).'</td>';
            echo '<td>'.stripslashes($row['COUNT(idc)']).'</td>';
            echo '</tr>';
        }

        echo "<h3>Componente</h3>";

        /// furnizori

        $query = "SELECT oras, COUNT(idf)
        FROM furnizori
        GROUP BY oras;";

        $result = mysqli_query($dsn, $query);

        if (!$result)
        {
            die('Error:'.mysqli_error($dsn));
        }

        echo ' <Table class="table">
        <tr>
            <th>#</th>
            <th>Oras</th>
            <th>Nr Furnizori:</th>
        </tr>'; 

        $rows = mysqli_num_rows($result);

        for ($i=0; $i < $rows; $i++)
        {
            echo '<tr>';
            $row = mysqli_fetch_assoc($result);
            echo '<th>'.stripslashes($i+1).'</th>';
            echo '<td>'.stripslashes($row['oras']).'</td>';
            echo '<td>'.stripslashes($row['COUNT(idf)']).'</td>';
            echo '</tr>';
        }

        echo "<h3>Furnizori</h3>";

        mysqli_close($dsn);
    ?>
</div>

</body>
</html>