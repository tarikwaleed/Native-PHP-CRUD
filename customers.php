<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
echo "<h1>All customers  </h1>";



### I need to save the customers data to the file

try {

    $customers =  file("customers");
    echo "<table class='table'>
        <tr> 
        <th> id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Skills</th>
        <th>Deparntment</th>
        <th> Edit </th>
        <th> Delete</th>
        </tr>";
    foreach ($customers as $customer) {
        echo '<tr>';
        $customers_data = explode(':', $customer);
        foreach ($customers_data as $piece_of_info) {
            echo "<td> {$piece_of_info}</td>";
        }
        echo " 
        <td><a class='btn btn-warning' href='registeration.php?" . http_build_query(['update_data' => $customers_data]) . "'>Edit</a></td>
        <td> <a class='btn btn-danger' href='deletecustomer.php?id={$customers_data[0]}'> Delete</a></td>
 
        </tr>";
    }
    echo "</table>";
} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<a href="registeration.php" class="btn btn-primary">Add new customer </a>