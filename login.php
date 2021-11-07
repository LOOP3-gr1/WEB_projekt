<?php
require_once('includes/header.php');
// header inkluderes.
if (isset($_POST['email']) && isset($_POST['password'])) {
    // kontrollere om variabler er blevet defineret.
    $email_temp = $_POST['email'];
    $password_temp = $_POST['password'];
    // to variabler defineres.

    $query = "SELECT * FROM users WHERE email = '$email_temp'";
    // variablen $query defineres som den data der vægtes fra "users" i "email" i varablen $email_temp.
    $result = mysqli_query($con, $query);
    // variablen $result defineres som det indhold som bliver hentet fra variablerne $con og $query i databasen. 
    if (!$result) {
        // betyder hvis variablen $result opfyldes, så gælder koden under. 
        echo "<p class='error'>MySQL Error: " . mysqli_error($con) . ".</p>";
        require_once('includes/footer.php');
        // footer inkluderes.
        die();
        // afslutter kommandoen med funktionen die().
    } elseif (mysqli_num_rows($result)) {
        // kommandoen er en kombination af if og else. 
        $row = mysqli_fetch_assoc($result);
        // variablen $row defineres som de resultater der hendes fra variablen $result (som en associativ matrix).
        // https://www-w3schools-com.translate.goog/php/func_mysqli_fetch_assoc.asp?_x_tr_sl=en&_x_tr_tl=da&_x_tr_hl=da&_x_tr_pto=nui,sc
        $user_id = $row['user_id'];
        $email = $row['email'];
        $password = $row['password'];
        // tre variabler defineres.

        $token = (password_verify($password_temp, $password));
        // variablen $token defineres som det kodeord med et matchende hash (krypteret kode). 

        if ($token == $password) {
            // hvis variablen $token er lig med $password, så vil følgende kode gælde.
            $_SESSION['user_id'] = $user_id;
            $query2 = "SELECT * FROM user_info WHERE user_id = '$user_id'";
            // variablen $query2 defineres som den data der vægtes fra "users_info" i user_id i variablen $user_id.
            $result2 = mysqli_query($con, $query2);
            // variablen $result2 defineres som det indhold som bliver hentet fra variablerne $con og $query2 i databasen. 
            if (!$result2) {
                // betyder hvis variablen $result2 ikke opfyldes, så gælder koden under. 
                echo "<p class='error'>MySQL Error: " . mysqli_error($con) . ".</p>";
                require_once('includes/footer.php');
                // footer inkluderes.
                die();
                // afslutter kommandoen med funktionen die().
            } else {
                $row2 = mysqli_fetch_assoc($result2);
                // samme definition som ved $row.
                $first_name = $row2['first_name'];
                $last_name = $row2['last_name'];
                $user_type = $row2['user_type'];
                $_SESSION['user_type'] = $user_type;
                /* header("Refresh:1; url=index.php"); */
                echo "<p class='intro'>Welcome " . $first_name . " " . $last_name . ". You are now logged in.</p>";
                require_once('includes/footer.php');
                // footer inkluderes.
            }
            if ($_SESSION['user_type'] == 1) {
                header("Refresh:1; url=admin_page.php");
                // hvis brugeren har valgt at de er user_type = admin, så vil de blive sendt hertil. 
                require_once('includes/footer.php');
                die();
            } elseif ($_SESSION['user_type'] == 2) {
                header("Refresh:1; url=plejer_page.php");
                // hvis brugeren har valgt at de er user_type = plejer, så vil de blive sendt hertil. 
                require_once('includes/footer.php');
                die();
            } elseif ($_SESSION['user_type'] == 3) {
                header("Refresh:1; url=tekniker_page.php");
                // hvis brugeren har valgt at de er user_type = tekniker, så vil de blive sendt hertil. 
                require_once('includes/footer.php');
                die();
            }                      
       
        }       
        } else {
            // Ellers gælder koden nedenfor (og betyder at man har indtastet forkert kodeord, email eller ikke har oprettet sig som bruger.)
            echo "<p class='error'>Invalid email/password combination.</p>";
            require_once('includes/footer.php');
        }  
        
        
} else { 
    
?>

    <!-- centrerer alt inhold i body -->

    <body class="text-center">
        <main class="form-signin">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <!-- Logo = margin-bottom til 1.5rem og h3 =margin-bottom 1rem, normal tekst-->
                <img class="mb-4" src="curatechlogo.jpg" alt="logo" width="120" height="100">
                <h1 class="h3 mb-3 fw-normal">Log-In</h1>

                <!-- Flydende placerholder når man trykker på brugernavn. Form-control styler inputboxen -->
                <div class="form-floating">
                    <input type="email" class="form-control" id="flydendeBrugernavn" placeholder="Email" name="email">
                    <label for="flydendeBrugernavn">Email</label>
                </div>

                <!-- Flydende placerholder når man trykker på adgangskode. Form-control styler inputboxen -->
                <div class="form-floating">
                    <input type="password" class="form-control" id="flydendeAdgangskode" placeholder="Password" name="password">
                    <label for="flydendeAdgangskode">Password</label>
                </div>

                <!-- Checkbox = margin-bottom 1rem -->
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Husk oplysninger i 15 minutter
                    </label>
                </div>

                <!-- log-in knap width=50 og stylet -->
                <button class="w-50 btn btn-lg btn-primary" type="submit">Log-in</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021-2021</p>

            </form>
        </main>

    <?php
}
require_once('includes/footer.php');
    ?>
