<?php
require_once 'header.php';

if (!$loggedIn) die("</div></body></html>");

$result = prepareQuery("SELECT * FROM users WHERE nickname= :nickname", [':nickname' => $_SESSION['user']]);
if (!empty($result))
    extract($result[0]);

if (isset($_POST['name'])) {
  $name = processString($_POST['name']);
  $surname = processString($_POST['surname']);
  $password = processString($_POST['password']);

  $password = password_hash($password, PASSWORD_DEFAULT);
  prepareQuery("UPDATE `users` 
                      SET `name` = :name, `surname` = :surname, `password_hash` = :password 
                      WHERE id = :id",
    [':name' => $name, ':surname' => $surname, ':password' => $password, ':id' => $id]
  );
  die('<h4>Данные обновлены</h4></div></body></html>');
}

echo <<<_END
      <form data-ajax='false' method='post'
        action='profile.php'>
      <div class="mb-30">
        <label>Name</label><br>
        <input type='text' maxlength='16' name='name' value='$name'>
      </div>
      <div class="mb-30">
        <label>Surname</label><br>
        <input type='text' maxlength='16' name='surname' value='$surname'>
      </div>
      <div class="mb-30">
        <label>New password</label><br>
        <input type='password' maxlength='55' name='password' value=''>
      </div>
      <div class="mb-30">
        <label></label>
        <input data-transition='slide' type='submit' value='Change'>
      </div>
      </form>
    </div><br>
  </body>
</html>
_END;