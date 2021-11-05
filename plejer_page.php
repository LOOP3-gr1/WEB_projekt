<?php
require_once('includes/header.php');
if (!isset($_SESSION['user_id'])) {
    echo "<p class='error'>You need to be logged in to get access to this page.</p>";
    require_once('includes/footer.php');
    die();
}

if ($_SESSION['user_type'] != 2) {
    echo "<p class='error'>You need a plejer account to access to this page.</p>";
    require_once('includes/footer.php');
    die();
} else { 

    ?>
    <main role="main">
        <div class="p-5 mb-4 rounded-3 autumn">
            <div class="container-fluid py-5 bg-transp">
                <h1 class="display-6 fw-bold text-center">Plejer</h1>
            </div>
        </div>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col">
                    <p class="intro">Ja du er plejer?<br> Hej hej.</p>
                </div>
            </div>
        </div>
    
    
    </main>
    <?php
    }
    require_once('includes/footer.php');
    ?>
