<?php
include "PhpScripts/Header.php";

if(!isset($_SESSION["agree"])){
    die('<script>window.location = "Disclaimer.php";</script>');
}

if(!isset($errors)){
    $errors = [];
}
if(!isset($_POST)){
    $_POST = [];
}

include "PhpScripts/Functions.php";

$errors = [];

if (isset($_POST) && $_POST) {
    if (!isset($_POST['name']) || !$_POST['name']) {
        $errors['name'] = "Name is required.";
    }
    if (isset($_POST['postal-code']) && $_POST['postal-code']) {
        $errors['postal-code'] = validatePostalCode($_POST['postal-code']);
    } else {
        $errors['postal-code'] = "Postal code must not be blank.";
    }
    if (isset($_POST['phone-number']) && $_POST['phone-number']) {
        $errors['phone-number'] = validatePhone($_POST['phone-number']);
    } else {
        $errors['phone-number'] = "Phone Number must not be blank.";
    }
    if (isset($_POST['email']) && $_POST['email']) {
        $errors['email'] = validateEmail($_POST['email']);
    } else {
        $errors['email'] = "Email must not be blank.";
    }
    if (isset($_POST['contact-method']) && $_POST['contact-method']) {
        if ($_POST['contact-method'] == "email") {
            $contact = "Our customer service will contact you at $_POST[email].";
        } else {
            $period = '';
            if (isset($_POST['morning'])) {
                $period .= 'morning';
            }
            if (isset($_POST['afternoon'])) {
                if ($period) $period .= ' or ';
                $period .= 'afternoon';
            }
            if (isset($_POST['evening'])) {
                if ($period) $period .= ' or ';
                $period .= 'evening';
            }
            if ($period) {
                $contact = "Our customer service will call you tomorrow $period at " . $_POST['phone-number'] . ".";
            } else {
                $errors['period'] = "When preferred contact method is phone, you must select at least one period of the day to contact.";
            }
        }
    } else {
        $errors['contact-method'] = "You must select a contact method.";
    }
}

$hasError = false;

foreach ($errors as $e) {
    if ($e) {
        $hasError = true;
        break;
    }
}

if (!isset($_POST) || !$_POST || (isset($errors) && $hasError)) {
    if(!isset($errors)){
        $errors = [];
    }
    if(!isset($_POST)){
        $_POST = [];
    }
    if (isset($_SESSION['customer_info'])) {
        $_POST = $_SESSION["customer_info"];
        $contact = $_SESSION["contact"];
    }
    ?>
    <style>
        label {
            font-weight: bold;
        }

        input+label {
            font-weight: normal;
        }
    </style>
    <form action="" method="post">
        <div class="row mt-1">
            <div class="col-xs-4 text-center">
                <h1>Customer Info</h1>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <label for="name">Name</label>
            </div>
            <div class="col-xs-4">
                <input value="<?=$_POST ? $_POST['name'] : "" ?>" class="form-control" type="text" name="name" id="name">
            </div>
            <div class="col-xs-4 text-danger">
                <?=isset($errors['name']) ? $errors['name'] : "" ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <label for="postal-code">Postal Code</label>
            </div>
            <div class="col-xs-4">
                <input value="<?=$_POST ? $_POST['postal-code'] : "" ?>" class="form-control" type="text" name="postal-code" id="postal-code">
            </div>
            <div class="col-xs-4 text-danger">
                <?=isset($errors['postal-code']) ? $errors['postal-code'] : "" ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <label for="phone-number">Phone Number:</label>
                <p>(nnn-nnn-nnnn)</p>
            </div>
            <div class="col-xs-4">
                <input value="<?=$_POST ? $_POST['phone-number'] : "" ?>" class="form-control" type="text" name="phone-number" id="phone-number">
            </div>
            <div class="col-xs-4 text-danger">
                <?=isset($errors['phone-number']) ? $errors['phone-number'] : "" ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <label for="email">Email Address:</label>
            </div>
            <div class="col-xs-4">
                <input value="<?=$_POST ? $_POST['email'] : "" ?>" class="form-control" type="text" name="email" id="email">
            </div>
            <div class="col-xs-4 text-danger">
                <?=isset($errors['email']) ? $errors['email'] : "" ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <hr>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <label for="">
                    Prefered Contact Method:
                </label>
            </div>
            <div class="col-xs-4">
                <input <?=$_POST && isset($_POST['contact-method']) && $_POST['contact-method']=="phone" ? "checked" : "" ?> type="radio" name="contact-method" value="phone" id="phone-method">
                <label for="phone-method">Phone</label>
                &nbsp;
                <input <?=$_POST && isset($_POST['contact-method']) && $_POST['contact-method']=="email" ? "checked" : "" ?> type="radio" name="contact-method" value="email" id="email-method">
                <label for="email-method">Email</label>
            </div>
            <div class="col-xs-4 text-danger">
                <?=isset($errors['contact-method']) ? $errors['contact-method'] : "" ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4">
                <label for="">
                    If phone is selected, when can we contact you?
                    <br>
                    (check all aplicable)
                </label>
                <br>
                <input <?=$_POST && isset($_POST['morning']) ? "checked" : "" ?> type="checkbox" name="morning" id="morning">
                <label for="morning">Morning</label>
                &nbsp;
                <input <?=$_POST && isset($_POST['afternoon']) ? "checked" : "" ?> type="checkbox" name="afternoon" id="afternoon">
                <label for="afternoon">Afternoon</label>
                &nbsp;
                <input <?=$_POST && isset($_POST['evening']) ? "checked" : "" ?> type="checkbox" name="evening" id="evening">
                <label for="evening">Evening</label>
            </div>
            <div class="col-xs-4 text-danger">
                <?=isset($errors['period']) ? $errors['period'] : "" ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-xs-4 pt-2">
                <button type="submit" class="btn btn-primary">Calculate</button>
                <a href="" class="btn btn-primary clear-btn">Clear</a>
            </div>
        </div>
    </form>
<?php
}else{
    $_SESSION["customer_info"] = $_POST;
    $_SESSION["contact"] = $contact;
    die('<script>window.location = "DepositCalculator.php";</script>');
}
?>

<?php
include "PhpScripts/Footer.php";
?>