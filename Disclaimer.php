<?php
include "PhpScripts/Header.php";

$error = "";
if(isset($_POST) && $_POST){
    if(isset($_POST["agree"])){
        $_SESSION["agree"] = 1;
        die('<script>window.location = "CustomerInfo.php";</script>');
    }else{
        $error = "You must agree the terms and conditions!";
    }
}

?>
<form action="" method="post">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">
                Terms and Conditions
            </h1>
            
            <ul class="list-group">
                <li class="list-group-item">
                    I agree to abide by the Bank's Terms and Conditions and rules in force and the changes thereto in Terms and Conditions from time to time relating to my account as communicated and made available on the Bank's website
                </li>
                <li class="list-group-item">
                    I agree that the bank before opening any deposit account. will carry out a due diligence as required under Know Your Customer guidelines of the bank. I would be required to submit necessary documents or proofs. such as identity addres& photograph and any such information. I agree to submit the above documents again at periodic interval& as may be required by the Bank.
                </li>
                <li class="list-group-item">
                    I agree that the Bank can at its sole discretion. amend any of the services/facilities given in my account either wholly or partially at any time by giving me at least 30 days notice and/or provide an option to me to switch to other services/facilities
                </li>
            </ul>
        </div>
        <br>
        <div class="col-12 text-danger">
            <?=$error?>
        </div>
        <div class="col-12">
            <input type="checkbox" name="agree" id="agree">
            <label for="agree" style="font-weight: normal">
                I have read and agree with the terms and conditions
            </label>
        </div>
        <div class="col-12">
            <input type="hidden" name="submitted" value="1">
            <button class="btn btn-primary">Start</button>
        </div>
    </div>
</form>

<?php
include "PhpScripts/Footer.php";
?>