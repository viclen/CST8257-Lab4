<?php

function validatePrincipal($amount)
{
    if ($amount <= 0) {
        return "Principal Amount must be greater than zero.";
    }
}

function validateRate($amount){
    if (is_numeric($amount)) {
        if ($amount <= 0) {
            return "Interest Rate must be greater than zero.";
        }
    } else {
        return "Interest Rate must be numeric.";
    }
}

function validateYears($years) {
    if (is_numeric($years)) {
        if ($years <= 0 || $years > 20) {
            return "Years to Deposit must be between 1 and 20.";
        }
    } else {
        return "Years to Deposit must be numeric.";
    }
}

function validateName($name) {
    
}

function validatePostalCode($postalCode) {
    return (preg_match("/\b[a-zA-Z][0-9][a-zA-Z]\s*[0-9][a-zA-Z][0-9]\b/", $postalCode)) ? "" : "Please insert a valid postal code.";
}

function validatePhone($phone) {
    return (preg_match("/\b[2-9][0-9]{2}-[2-9][0-9]{2}-[0-9]{4}\b/", $phone)) ? "" : "Please insert a valid phone number.";
}

function validateEmail($email) {
    return (preg_match("/\b[a-zA-Z0-9._%+-]+@(([a-zA-Z0-9-]+)\.)+[a-zA-Z]{2,4}\b/", $email)) ? "" : "Please insert a valid email.";
}