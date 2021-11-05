<?php
require_once('includes/header.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email_temp = $_POST['email'];
    $password_temp = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email_temp'";
    $result = mysqli_query($con, $query);
    if (!$result) {
        echo "<p class='error'>MySQL Error: " . mysqli_error($con) . ".</p>";
        require_once('includes/footer.php');
        die();
    } elseif (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        $email = $row['email'];
        $password = $row['password'];

        $token = (password_verify($password_temp, $password));

        if ($token == $password) {
            $_SESSION['user_id'] = $user_id;
            $query2 = "SELECT * FROM user_info WHERE user_id = '$user_id'";
            $result2 = mysqli_query($con, $query2);
            if (!$result2) {
                echo "<p class='error'>MySQL Error: " . mysqli_error($con) . ".</p>";
                require_once('includes/footer.php');
                die();
            } else {
                $row2 = mysqli_fetch_assoc($result2);
                $first_name = $row2['first_name'];
                $last_name = $row2['last_name'];
                $user_type = $row2['user_type'];
                $_SESSION['user_type'] = $user_type;
                /* header("Refresh:1; url=index.php"); */
                echo "<p class='intro'>Welcome " . $first_name . " " . $last_name . ". You are now logged in.</p>";
                require_once('includes/footer.php');
            }
            if ($_SESSION['user_type'] == 1) {
                header("Refresh:1; url=admin_page.php");
                require_once('includes/footer.php');
                die();
            } elseif ($_SESSION['user_type'] == 2) {
                header("Refresh:1; url=plejer_page.php");
                require_once('includes/footer.php');
                die();
            } elseif ($_SESSION['user_type'] == 3) {
                header("Refresh:1; url=tekniker_page.php");
                require_once('includes/footer.php');
                die();
            }                      
       
        }       
        } else {
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