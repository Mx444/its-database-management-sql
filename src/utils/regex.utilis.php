<?php

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateString($name)
{
    return preg_match('/^[a-zA-Z\s]+$/', $name);
}

function validatePhone($number)
{
    return preg_match('/^[0-9]+$/', $number);
}
