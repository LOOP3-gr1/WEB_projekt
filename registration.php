<?php
require_once('includes/header.php');
// header inkluderes
if (!isset($_SESSION['user_id'])) {
// denne funktion gør at hvis isset funktionen ikke er opfyldt vil der ikke blive gemt information omkring "user_id".
    echo "<p class='error'>You need to be logged in to get access to this page.</p>";
    require_once('includes/footer.php');
// footer inkluderes.
    die();
// afslutter kommandoen med funktionen die().
}

if ($_SESSION['user_type'] != 1) {
// hvis variablen $_SESSION['user_type'] ikke er lig 1 udføres koden nedenfor. 
    echo "<p class='error'>You need an administrator account to access to this page.</p>";
    require_once('includes/footer.php');
// footer inkluderes.
    die();
// afslutter kommandoen med funktionen die().
}

//print_r($_POST); (SKAL DET BRUGES??)
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])) {
// kontrollere om variabler er blevet defineret.
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
// fem variabler defineres. 

    $token = password_hash($password, PASSWORD_DEFAULT);
// kodeordet krypteres vha. funktionen "password_hash". 
// variablen $token er blevet defineret. 

    $query = "INSERT INTO users (email, password) VALUES ('$email', '$token')";
// udfører en forespørgsel til databasen om at email og det kypterede kodeord indsættes i "users". 
    $result = mysqli_query($con, $query);
// variablen $result defineres som det indhold som bliver hentet fra variablerne $con og $query i databasen. 

    if (!$result) {
// hvis indputtet ikke er lig med variablen $result, så vil følgende kode gælde.
        $errorcode = mysqli_errno($con);
// variablen $errorcode defineres den fejlkode som opstår i variablen $con.
// Definition: https://www-w3schools-com.translate.goog/php/func_mysqli_errno.asp?_x_tr_sl=en&_x_tr_tl=da&_x_tr_hl=da&_x_tr_pto=nui,op,sc 
        if ($errorcode === 1062) {
// hvis variablen $errorcode er identisk med 1062 gælder følgende kode.
            echo "<p class='error'>This email is already registered in the system.</p>";
            require_once('includes/footer.php');
// footer inkluderes.
            die();
// afslutter kommandoen med funktionen die().
        } else {
// ellers gælder koden. 
            echo "<p class='error'>Couldn't register user: " . mysqli_error($con) . ".</p>";
            require_once('includes/footer.php');
// footer inkluderes.
            die();
// afslutter kommandoen med funktionen die().
        }
    }
    if ($result === TRUE) {
// hvis variablen $result er identisk med TRUE gælder følgende kode.
        $user_id = mysqli_insert_id($con);
// variablen $user_id defineres. 
// mysqli_insert_id af variablen $con er genereret med auto_increment.  
        $query2 = "INSERT INTO user_info VALUES ('$user_id', '$first_name', '$last_name', '$user_type')";
// variablen $query2 har samme definition som variablen $query, dog hvor informationen indsættes andetsteds og variablerne er lidt anderledes. 
        $result2 = mysqli_query($con, $query2);
// variablen $result2 har samme definition som variablen $result, men hvor den trækker information ud fra varialen $query2. 
        if (!$result2) {
// hvis indputtet ikke er lig med variablen $result2, så vil følgende kode gælde.
            echo "<p class='error'>Couldn't register user: " . mysqli_error($con) . ".</p>";
            require_once('includes/footer.php');
            die();
        } else {
// ellers gælder koden. 
            echo "<p class='welcome'>User is now registered.</p>";
            header("Refresh:1; url=registration.php"); 
//evt få user is now registered til at komme op på siden
        }
    }
} else {
?>

    <main role="main">
        <fieldset> <!-- elementet fieldset bliver brugt til at gruppere flere kommandoer i én formular/boks. -->
            <legend> <!-- legend bliver brugt til at formatere layoutet i overskriften "h2" nedenfor. --> 
                <h2>User Registration</h2>
            </legend>
            <form class="row g-3 needs-validation" novalidate action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <!-- koden ovenfor er fra BootStrap og indeholder hele formularen samt dens struktur -->
            <!-- PHP delen i koden ovenfor formatere specielle symboler -->
                <div class="row">
                    <div class="col">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <!-- "validationCustom01" er BootStrap delen i First name feltet -->
                        <input type="text" class="form-control" id="validationCustom01" name="first_name" placeholder="Hans" required>
                        <!-- Ved "class" er der brugt BootStrap som gør at feltet skal udfyldes -->
                        <!-- Placeholder er brugt så brugeren kan se hvor de kan skrive information ind -->
                        <div class="valid-feedback">
                            <!-- Når koden ovenfor er gældende kommer denne meddelelse efterfølgende -->
                            Looks good!
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <!-- "validationCustom02" er BootStrap delen i Last name feltet -->
                        <input type="text" class="form-control" id="validationCustom02" name="last_name" placeholder="Hansen" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="validationCustomUsername" class="form-label">email</label>
                        <!-- "validationCustomUsername" er BootStrap delen i "username/email" feltet -->
                        <div class="input-group has-validation">
                            <!-- BootStrap bruges ovenfor -->
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <!-- Fra BootStrap og angiver om en valid email er angivet -->
                            <input type="email" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please enter your email.
                                <!-- Hvis email ikke er angivet, vil følgende meddelese komme frem -->
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="validationCustomPassword" class="form-label">Password</label>
                        <!-- "validationCustomPassword" er BootStrap delen i "passwrd/kodeord" feltet -->
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">?</span>
                            <input type="password" class="form-control" id="validationCustomPassword" name="password" aria-describedby="inputGroupPrepend" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            <!-- BootStrap som angiver visse krav for oprettelse af kodeord -->
                            <div class="invalid-feedback">
                                The password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
                                <!-- Hvis kodeordet ikke opfylder kravene fra BootStrap-delen ovenfor, vil denne meddelse komme frem -->
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
                <!-- Ovenfor bruges BootStrap til at brugeren kan vælge hvilken type bruger de vil registrer sig som -->
            </div>
             
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                    <!-- BootStrap form for en "submit" knap -->
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
// Footer inkluderes.
?>
