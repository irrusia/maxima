<?php
require_once 'header.php';
$error = $email = $password = "";

if (isset($_POST['email'])) {
  $email = processString($_POST['email']);
  $password = processString($_POST['password']);

  if ($email == "" || $password == "")
    $error = 'Необходимо заполнить email и password';
  else {
    $result = prepareQuery("SELECT email, nickname, password_hash FROM users
        WHERE email=:email", [':email' => $email]);

    if ($result === null) {
      $error = "Нет пользователя с таким email";
    }

    if (!password_verify($password, $result[0]['password_hash'])) {
      $error = "Неверный пароль";
    } else {
      $_SESSION['user'] = $result[0]['nickname'];
      $_SESSION['password'] = $result[0]['password_hash'];
      //$loggedIn = TRUE;
      die("<div class='center'>Вы вошли в свой Личный кабинет.
                   <a data-transition='slide'
                     href='profile.php'>Продолжить</a>
                     </div></div></body></html>");
    }
  }
}

echo <<<_END
      <form method='post' action='login.php'>
        <div class="mb-30">
          <label></label>
          <span class='error'>$error</span>
        </div>
        <div class="mb-30">
          <label></label>
          Введите пароль и email
        </div>
        <div class="mb-30">
          <label>Email</label><br>
          <input type='text' maxlength='55' name='email' value='$email'>
        </div>
        <div class="mb-30">
          <label>Пароль</label><br>
          <input type='password' maxlength='55' name='password' value='$password'>
        </div>
        <div class="mb-30">
          <label class></label>
          <input data-transition='slide' type='submit' value='Login'>
        </div>
      </form>
    </div>
  </body>
</html>
_END;

