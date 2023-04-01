<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$address = $_POST['addres'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$skills = implode(', ', $_POST['skills']);
$dept = $_POST['dept'];

if ($gender == 'male') {
    $title = 'Mr';
} else {
    $title = 'Mrs';
}
if (isset($_GET['id'])) {
    $is_update = true;
    $id=$_GET['id'];
}
echo $is_update;




$errors = [];
$formdata = [];
//validate firstName
if (empty($firstName) and isset($firstName)) {
    $errors['firstName'] = 'firstName required';
} else {
    $formdata["firstName"] = $firstName;
}
//validate lastName
if (empty($lastName) and isset($lastName)) {
    $errors['lastName'] = 'lastName required';
} else {
    $formdata["lastName"] = $lastName;
}
//validate gender
if (empty($gender) and isset($gender)) {
    $errors['gender'] = 'gender required';
} else {
    $formdata["gender"] = $gender;
}
if ($errors) {
    $errors_str = json_encode($errors);
    var_dump($errors_str);
    $url = "Location:registeration.php?errors={$errors_str}";

    if ($formdata) {
        $old_data = json_encode($formdata);
        $url .= "&old={$old_data}";
    }
    header($url);
} else {

    if (!$is_update) {
        try {
            $fileobj = fopen('customers', 'a');
            $id = time();
            $user_data = "{$id}:{$firstName}:{$lastName}:{$address}:{$gender}:{$skills}:{$dept}" . PHP_EOL;
            fwrite($fileobj, $user_data);
            fclose($fileobj);
            header('Location:customers.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        $file = 'customers';
        $contents = file_get_contents($file);
        $records = explode("\n", $contents);

        foreach ($records as $key => $record) {
            $fields = explode(':', $record);
            if ($fields[0] == $id) { // Replace with the ID you want to edit
                $fields[0] = $id;
                $fields[1] = $firstName; // Replace with the new first name
                $fields[2] = $lastName; // Replace with the new last name
                $fields[3] = $address; // Replace with the new address
                $fields[4] = $gender; // Replace with the new gender
                $fields[5] =  $skills; // Replace with the new skills
                $records[$key] = implode(':', $fields);
                break; // Exit the loop after the record has been updated
            }
        }

        // Join the records with the newline character and write them back to the file
        $new_contents = implode("\n", $records);
        file_put_contents($file, $new_contents);
        header('Location:customers.php');
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            max-width: 600px;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 10px;
        }

        .row label {
            flex-basis: 150px;
            font-weight: bold;
        }

        .row p {
            margin: 0;
        }
    </style>
</head>

<body>
    <h1>Thanks <?php echo $title . ' ' . $firstName ?> </h1>
    <h2>Please review your information </h2>
    <div class="container">
        <h2>Form Data</h2>
        <div class="row">
            <label>First Name:</label>
            <p><?php echo $firstName; ?></p>
        </div>
        <div class="row">
            <label>Last Name:</label>
            <p><?php echo $lastName; ?></p>
        </div>
        <div class="row">
            <label>Address:</label>
            <p><?php echo $address; ?></p>
        </div>
        <div class="row">
            <label>Country:</label>
            <p><?php echo $country; ?></p>
        </div>
        <div class="row">
            <label>Gender:</label>
            <p><?php echo $gender; ?></p>
        </div>
        <div class="row">
            <label>Skills:</label>
            <p><?php echo $skills; ?></p>
        </div>
        <div class="row">
            <label>Department:</label>
            <p><?php echo $dept; ?></p>
        </div>
    </div>
</body>

</html>