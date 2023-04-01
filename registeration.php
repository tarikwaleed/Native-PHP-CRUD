<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

echo "<div class='container fs-4'  >";
echo "<h1>All users  </h1>";
$is_update = false;
$is_add = false;
$is_redirect = false;
if (isset($_GET["errors"])) {
    $errors = json_decode($_GET["errors"], true);
}
if (isset($_GET["old_data"])) {
    echo 'refill the form';
    $is_redirect = true;
    $old_data = json_decode($_GET["old_data"], true);
    $firstName = $_GET["old_data"]['firstName'];
    $lastName = $_GET["old_data"]['lastName'];
    $address = $_GET["old_data"]['address'];
    $gender = $_GET["old_data"]['gender'];
    $dept = $_GET["old_data"]['dept'];
    $skills = explode(',', $_GET["old_data"]['skills']);
}
if (isset($_GET['update_data'])) {
    echo 'update existing user';
    $is_update = true;
    $id = $_GET["update_data"][0];
    $firstName = $_GET["update_data"][1];
    $lastName = $_GET["update_data"][2];
    $address = $_GET["update_data"][3];
    $gender = $_GET["update_data"][4];
    $skills = explode(',', $_GET["update_data"][5]);
    $dept = $_GET["update_data"][6];
}
echo 'Add new User'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Registeration</title>
</head>

<body>
    <div class="container-fluid">
        <form action="<?php if ($is_update) {
                            echo 'welcome.php?id=' . $id;
                        } else {
                            echo 'welcome.php';
                        } ?>" method="post">
            <div class="mb-3">
                <label for="first-name" class="form-label">First Name</label>
                <input value="<?php
                                if ($is_update) {
                                    echo $_GET["update_data"][1];
                                }
                                if ($is_redirect) {
                                    $firstName = $_GET["old_data"]['firstName'];
                                }
                                ?>
                                 " type=text" class="form-control" name="first-name" id="first-name" aria-describedby="helpId" placeholder="enter your first name">
                <span class="text-danger"> <?php if (isset($errors['firstName'])) echo $errors['firstName']; ?> </span>
            </div>
            <div class="mb-3">
                <label for="last-name" class="form-label">Last Name</label>
                <input value="<?php if ($is_update or $is_redirect) echo $lastName ?> " type="text" class="form-control" name="last-name" id="last-name" aria-describedby="helpId" placeholder="enter your last name">
                <span class="text-danger"> <?php if (isset($errors['lastName'])) echo $errors['lastName']; ?> </span>
            </div>
            <div class="mb-3">
                <label for="addres" class="form-label">Address</label>
                <textarea class="form-control" name="addres" id="addres" rows="3"><?php if ($is_update or $is_redirect) echo $address ?></textarea>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select form-select-lg" name="country" id="country">
                    <option value="egypt">Egypt</option>
                    <option value="usa">USA</option>
                    <option value="uk">UK</option>
                    <option value="germany">Germany</option>
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" rquired <?php if ($is_update or $is_redirect) if ($gender == 'male') echo 'checked'; ?>>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" required <?php if ($is_update or $is_redirect) if ($gender == 'female') echo 'checked'; ?>>
                <label class="form-check-label" for="female">Female</label>
                <span class="text-danger"> <?php if (isset($errors['gender'])) echo $errors['gender']; ?> </span>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="skills">Skills</label>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="php" id="skill1" <?php if ($is_update or $is_redirect) if (in_array("PHP", $skills)) echo "checked"; ?>>
                        <label class="form-check-label" for="skill1">
                            PHP
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="MySQL" id="skill2" <?php if ($is_update or $is_redirect) if (in_array("MySQL", $skills)) echo "checked"; ?>>
                        <label class="form-check-label" for="skill2">
                            MySql
                        </label>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="js" id="skill3" <?php if ($is_update or $is_redirect) if (in_array("js", $skills)) echo "checked"; ?>>
                        <label class="form-check-label" for="skill3">
                            JS
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="html" name="skills" id="skill4" <?php if ($is_update or $is_redirect) if (in_array("html", $skills)) echo "checked"; ?>>
                        <label class="form-check-label" for="skill4">
                            HTML
                        </label>
                    </div>

                </div>
                <!-- /.col-md-6 -->
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

            <div class="mb-3">
                <label for="dept" class="form-label">Department</label>
                <select class="form-select form-select-lg" name="dept" id="dept">
                    <option value="open source" <?php if ($is_update or $is_redirect) if ($dept == 'open source') echo 'selected'; ?>>Open Source</option>
                    <option value="pwd" <?php if ($dept == 'pwd') echo 'selected'; ?>>PWD</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="captch">78ujhJk</label>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="captcha" id="captcha" aria-describedby="helpId" placeholder="Enter the above code">
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-primary">Reset</button>


        </form>

    </div>
    <!-- /.container-fluid -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>