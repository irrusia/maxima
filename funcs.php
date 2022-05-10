<?php
$host = 'mysql';    // Change as necessary
$dbname = 'demo';   // Change as necessary
$user = 'root';   // Change as necessary
$pass = 'root';     // Change as necessary
$chrs = 'utf8';
$attr = "mysql:host=$host;dbname=$dbname;charset=$chrs";
$opts =
  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];

try {
  $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}

/*function createTable($name, $query)
{
  queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
  echo "Table '$name' created or already exists.<br>";
}

function queryMysql($query)
{
  global $pdo;
  return $pdo->query($query);
}*/

function prepareQuery($query, $params)
{
  global $pdo;
  $sth = $pdo->prepare($query);
  $result = $sth->execute($params);

  if($result === false){
    return null;
  }

  return $sth->fetchAll();
}

function destroySession()
{
  ob_start();
  $_SESSION = array();

  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]
    );
  }

  session_destroy();
  ob_end_clean();
}

function processString($var)
{
  $var = strip_tags($var);
  $var = htmlentities($var);

  return $var;
}
