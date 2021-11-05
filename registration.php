<?php
require_once('includes/header.php');
if (!isset($_SESSION['user_id'])) {
    echo "<p class='error'>You need to be logged in to get access to this page.</p>";
    require_once('includes/footer.php');
    die();
}

if ($_SESSION['user_type'] != 1) {
    echo "<p class='error'>You need an administrator account to access to this page.</p>";
    require_once('includes/footer.php');
    die();
}

//print_r($_POST);
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $token = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password) VALUES ('$email', '$token')";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $errorcode = mysqli_errno($con);
        if ($errorcode === 1062) {
            echo "<p class='error'>This email is already registered in the system.</p>";
            require_once('includes/footer.php');
            die();
        } else {
            echo "<p class='error'>Couldn't register user: " . mysqli_error($con) . ".</p>";
            require_once('includes/footer.php');
            die();
        }
    }
    if ($result === TRUE) {
        $user_id = mysqli_insert_id($con);
        $query2 = "INSERT INTO user_info VALUES ('$user_id', '$first_name', '$last_name', '$user_type')";
        $result2 = mysqli_query($con, $query2);
        if (!$result2) {
            echo "<p class='error'>Couldn't register user: " . mysqli_error($con) . ".</p>";
            require_once('includes/footer.php');
            die();
        } else {
            echo "<p class='welcome'>User is now registered.</p>";
            header("Refresh:1; url=registration.php"); //evt få user is now registered til at komme op på siden
        }
    }
} else {
?>

    <main role="main">
        <fieldset>
            <legend>
                <h2>User Registration</h2>
            </legend>
            <form class="row g-3 needs-validation" novalidate action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="row">
                    <div class="col">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="first_name" placeholder="Hans" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" name="last_name" placeholder="Hansen" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="validationCustomUsername" class="form-label">email</label>
                        <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please enter your email.
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationCustomPassword" class="form-label">Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">?</span>
                            <input type="password" class="form-control" id="validationCustomPassword" name="password" aria-describedby="inputGroupPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            <div class="invalid-feedback">
                                The password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                <label>Create user as:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="validationFormCheck1" name="user_type" value="1" required>
                    <label class="form-check-label" for="validationFormCheck2">Administrator</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="validationFormCheck2" name="user_type" value="2" required>
                    <label class="form-check-label" for="validationFormCheck3">Plejer</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="validationFormCheck3" name="user_type" value="3" required>
                    <label class="form-check-label" for="validationFormCheck3">Tekniker</label>
                    <div class="invalid-feedback">Please select a user type.</div>
                </div>
            </div>
             
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </fieldset>
    </main>
   
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
<?php
}
require_once('includes/footer.php');
?>