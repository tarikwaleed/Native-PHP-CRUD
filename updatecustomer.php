
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
echo "<h1>Update customer</h1>";
print_r($_POST);
$id = $_GET['id'];
$new_first_name = $_POST['first-name'];
$new_last_name = $_POST['last-name'];
$new_address = $_POST['addres'];
$new_gender = $_POST['gender'];
$new_skills = $_POST['skills'];
print_r($new_skills);
$file = 'customers';
$contents = file_get_contents($file);
$records = explode("\n", $contents);

foreach ($records as $key => $record) {
    $fields = explode(':', $record);
    if ($fields[0] == $id) { // Replace with the ID you want to edit
        $fields[1] = $new_first_name; // Replace with the new first name
        $fields[2] = $new_last_name; // Replace with the new last name
        $fields[3] = $new_address; // Replace with the new address
        $fields[4] = $new_gender; // Replace with the new gender
        $fields[5] = implode(',', $new_skills); // Replace with the new skills
        $records[$key] = implode(':', $fields);
        break; // Exit the loop after the record has been updated
    }
}

// Join the records with the newline character and write them back to the file
$new_contents = implode("\n", $records);
file_put_contents($file, $new_contents);
header('Location:customers.php');
