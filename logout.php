<?php
require_once 'header.php';

if (isset($_SESSION['user']))
{
    destroySession();
    echo "<br><div class='center'>Вы вышли из аккаунта. Войти
         <a data-transition='slide'
           href='login.php'>в аккаунт</a>.</div>";
}
else echo "<div class='center'>Вы не залогинены.</div>";

?>
  </div>
  </body>
  </html>
