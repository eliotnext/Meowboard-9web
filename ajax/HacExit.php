<?php
  setcookie('nickname', $username, time()-3600*24*30, "/");
  unset($_COOKIE['nickname']);
  echo true;
?>
