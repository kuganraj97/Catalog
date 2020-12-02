<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    
    // TODO 1: Create short variable names.

        $searchtype;
        $searchterm;

    // TODO 2: Check and filter data coming from the user.

        $searchtype=isset($_POST["searchtype"])?$_POST["searchtype"]:"";
        $searchterm=isset($_POST["searchterm"])?$_POST["searchterm"]:"";

    // TODO 3: Setup a connection to the appropriate database.

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "book";
        $conn = new mysqli($servername,$username,$password,$database);
        if($conn->connect_error){ 
            die("database Connect failed".$conn->connect_error);
        }
    // TODO 4: Query the database.
    
        $query="SELECT * FROM catalogs WHERE ".$searchtype." = '$searchterm' ";
        $result = $conn->query($query);
        if(!$result) {
            die ("Error ");
        } 

    // TODO 6: Display the results back to user.

        $rows = $result->num_rows;
        echo "<table>
        <tr>
            <th>ISBN</th>
            <th>Author</th>
            <th>Title</th>
            <th>Price</th>
        </tr>
          ";
        if($rows>0){
            for($j = 0; $j < $rows; $j++)
            {
                $row = $result->fetch_array(MYSQLI_NUM);
                echo "<tr>";
                for($k = 0; $k < 4; $k++)
                {
                    echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
                }
                echo "</tr>";
            } 
        }else  {
            echo "<tr><td colspan='4'>No data found!</td></tr>";
        }  

        echo "</table>";

    // TODO 7: Disconnecting from the database.


    ?>
</body>
</html>
