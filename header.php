<?php
session_start();

echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' href='style.css' type='text/css'>
_INIT;

require_once 'funcs.php';

$userstr = 'Здравствуй, гость!';

if (isset($_SESSION['user']))
{
  $user = $_SESSION['user'];
  $loggedIn = TRUE;
  $userstr  = "Вы вошли как: $user";
}
else $loggedIn = FALSE;

echo <<<_MAIN
  </head>
  <body>
    <div data-role='page'>
      <div data-role='header'>
        <div class='username'>$userstr</div>
      </div>
      <div data-role='content'>
_MAIN;

if ($loggedIn)
{
  echo <<<_LOGGEDIN
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='edit'
            data-transition="slide" href='profile.php'>Редактировать профиль</a>
          <a data-role='button' data-inline='true' data-icon='action'
            data-transition="slide" href='logout.php'>Выйти</a>
        </div>
        
_LOGGEDIN;
}
else
{
  echo <<<_GUEST
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='plus'
            data-transition="slide" href='signup.php'>Регистрация</a>
          <a data-role='button' data-inline='true' data-icon='check'
            data-transition="slide" href='login.php'>Войти</a>
        </div>
_GUEST;
}