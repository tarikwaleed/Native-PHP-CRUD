<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
echo "<h1>Delete customer </h1>";

var_dump($_GET);
$customer_id = $_GET["id"];


$customers =  file('customers');

foreach ($customers as $index => $customer) {
    echo $customer, $index, '<br>';
    $customers_data = explode(':', $customer);
    if ($customers_data[0] == $customer_id) {
        unset($customers[$index]);  # delete from the array
        break;
    }
}


$fileobj = fopen("customers", 'w');
foreach ($customers as $customer) {
    fwrite($fileobj, $customer);
}
fclose($fileobj);

header("Location:customers.php");
