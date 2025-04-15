<!DOCTYPE html>
<?php

// Check if the message exists and if it's older than 1 minute
if (isset($_SESSION['message']) && isset($_SESSION['message_time'])) {
    // Calculate how much time has passed since the message was set
    $timePassed = time() - $_SESSION['message_time'];
    // Check if more than 60 seconds (1 minute) have passed
    if ($timePassed > 30) {
        // Unset the message and time if more than 1 minute has passed
        unset($_SESSION['message']);
        unset($_SESSION['status']);
        unset($_SESSION['message_time']);
    }
}
?>
<?php global $router; ?>
<html lang="fr">
<?php require_once('head.php'); ?>

<body>

    <!-- Header -->
    <header>
        <div id="er-header-sticky" class="er-header-area " data-bg-color="#202020">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-5">
                        <div class="er-header-logo">
                            <a href="#"><img src="<?php echo asset('assets/img/Logo/lacasadecom-logo-white.png'); ?>" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-7">
                        <div class="er-header-box d-flex justify-content-end align-items-center pt-2 pb-2">
                           
                            <div class="er-right-menu pl-120 d-flex align-items-center">
                                <div class="er-header-btn d-none d-lg-block">
                                    <a href="#contact" class="er-btn"><span>Contactez-nous</span></a>
                                </div>
                                <div class="er-header-bar d-xl-none">
                                    <button class="er-offcanvas-toogle"><i class="fal fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
</div>
    <!-- End Header -->