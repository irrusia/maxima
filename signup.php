<?php
require_once 'header.php';

$error = $email = $password = $nickname = $name = $surname = "";

if (isset($_SESSION['user'])) {
  ob_start();
  destroySession();
  ob_end_clean();
}


if (isset($_POST['nickname'])) {
  $nickname = processString($_POST['nickname']);
  $name = processString($_POST['name']);
  $surname = processString($_POST['surname']);
  $email = processString($_POST['email']);
  $password = processString($_POST['password']);

  if ($nickname == "" || $password == "" || $name == "" || $surname == "" || $email == "")
    $error = 'Необходимо заполнить все поля<br><br>';
  else {
    $result = prepareQuery("SELECT * FROM users WHERE nickname= :nickname", ['nickname' => $nickname]);

    if (empty($result)) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      prepareQuery("INSERT INTO `users` 
                        (`nickname`, `email`, `name`, `surname`, `password_hash`) 
                        VALUES(:nickname, :email, :name, :surname, :password)",
                        [':nickname' => $nickname, ':email' => $email, ':name' => $name, ':surname' => $surname, ':password' => $password]
      );
      die('<h4>Аккаунт создан</h4>Вы можете зайти в аккаунт по ссылке Войти.</div></body></html>');
    }
    else {
      $error = 'Пользователь  с таким nickname уже существует<br><br>';
    }
  }
}

echo <<<_END
      <form method='post' action='signup.php'>$error
      <div class="mb-30">
        <label>Nickname</label><br>
        <input type='text' maxlength='16' name='nickname' value='$nickname'
          onBlur='checkUser(this)'>
      </div>
      <div class="mb-30">
        <label>Name</label><br>
        <input type='text' maxlength='16' name='name' value='$name'>
      </div>
      <div class="mb-30">
        <label>Surname</label><br>
        <input type='text' maxlength='16' name='surname' value='$surname'>
      </div>
      <div class="mb-30">
        <label>Email</label><br>
        <input type='email' maxlength='55' name='email' value='$email'>
      </div>
      <div class="mb-30">
        <label>Password</label><br>
        <input type='password' maxlength='55' name='password' value='$password'>
      </div>
      <div class="mb-30">
        <label></label>
        <input data-transition='slide' type='submit' value='Sign Up'>
      </div>
    </div>
  </body>
</html>
_END;