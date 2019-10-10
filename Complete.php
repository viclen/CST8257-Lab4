<?php
include "PhpScripts/Header.php";

if (isset($_SESSION['customer_info'])) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Thank you,
                <span class="text-success"><?= $_SESSION['customer_info']['name'] ?></span>,
                for using our deposit calculation tool!
            </h1>
            <p>
                <?= $_SESSION["contact"]; ?>
            </p>
        </div>
    </div>
<?php
} else {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Thank you for using our deposit calculation tool!
            </h1>
        </div>
    </div>
<?php
}
include "PhpScripts/Footer.php";

session_destroy();
?>