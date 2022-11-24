<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $title = ($_SERVER['REQUEST_URI'] == '/login') ? $title = 'Login' : ($_SERVER['REQUEST_URI'] == '/register' ? $title = 'Register' : $title = 'Users'); ?>
    <title>Realtime Chat App | <?= $title; ?></title>
    <link rel="stylesheet" href="<?php assets('style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>