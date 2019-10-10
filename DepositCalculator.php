<?php
    include "PhpScripts/Header.php";
    
    if(!isset($_SESSION["agree"])){
        die('<script>window.location = "Disclaimer.php";</script>');
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

<?php
include "PhpScripts/Functions.php";

$errors = [];

if (isset($_POST) && $_POST) {
    if (isset($_POST['principal-amount']) && $_POST['principal-amount']) {
        $errors['principal-amount'] = validatePrincipal($_POST['principal-amount']);
    } else {
        $errors['principal-amount'] = "Principal Amount must not be blank.";
    }
    if (isset($_POST['interest-rate']) && $_POST['interest-rate']) {
        $errors['interest-rate'] = validateRate($_POST['interest-rate']);
    } else {
        $errors['interest-rate'] = "Interest Rate must not be blank.";
    }
    if (isset($_POST['years-to-deposit']) && $_POST['years-to-deposit']) {
        $errors['years-to-deposit'] = validateYears($_POST['years-to-deposit']);
    } else {
        $errors['years-to-deposit'] = "Years to Deposit must not be blank.";
    }
}

$hasError = false;

foreach ($errors as $e) {
    if ($e) {
        $hasError = true;
        break;
    }
}

?>
<form action="" method="post">
    <div class="row mt-1">
        <div class="col-xs-12">
            <br>
            <p>
                Enter principal amount, interest rate and select number of years to deposit.
            </p>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-xs-4">
            <label for="principal-amount">Principal Amount</label>
        </div>
        <div class="col-xs-4">
            <input value="<?=$_POST ? $_POST['principal-amount'] : "" ?>" class="form-control" type="number" step=".01" name="principal-amount" id="principal-amount">
        </div>
        <div class="col-xs-4 text-danger">
            <?=isset($errors['principal-amount']) ? $errors['principal-amount'] : "" ?>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-xs-4">
            <label for="interest-rate">Interest Rate (%)</label>
        </div>
        <div class="col-xs-4">
            <input value="<?=$_POST ? $_POST['interest-rate'] : "" ?>" class="form-control" type="number" step=".01" name="interest-rate" id="interest-rate">
        </div>
        <div class="col-xs-4 text-danger">
            <?=isset($errors['interest-rate']) ? $errors['interest-rate'] : "" ?>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-xs-4">
            <label for="years-to-deposit">Years To Deposit:</label>
        </div>
        <div class="col-xs-4">
            <select class="form-control custom-select" name="years-to-deposit" id="years-to-deposit">
                <?php
                    for($i=1;$i<=20;$i++){
                        ?>
                        <option <?=($_POST && $i==$_POST["years-to-deposit"]) ? "selected" : ""?> value="<?=$i?>"><?=$i?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="col-xs-4 text-danger">
            <?=isset($errors['years-to-deposit']) ? $errors['years-to-deposit'] : "" ?>
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
    if (isset($_POST) && $_POST && (!isset($errors) || !$hasError)) {
    ?>
    <div class="row mt-4">
        <div class="col-xs-12">
            <p>Following is the result of the calculation:</p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Year</th>
                        <th>Principal at Year Start</th>
                        <th>Interest for the Year</th>
                    </tr>
                    <?php
                        $interest = $_POST['interest-rate'];
                        $amount = $_POST['principal-amount'];

                        for ($i = 1; $i <= $_POST['years-to-deposit']; $i++) {
                            ?>
                        <tr>
                            <td>
                                <?= $i ?>
                            </td>
                            <td>
                                $ <?= number_format($amount, 2) ?>
                            </td>
                            <td>
                                $ <?= number_format($amount * $interest / 100, 2) ?>
                            </td>
                        </tr>
                    <?php
                            $amount += $amount * $interest / 100;
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
    include "PhpScripts/Footer.php";
?>
