<?php
  setcookie('nickname', $username, time()-3600*24*30, "/");
  unset($_COOKIE['nickname']);
  setcookie('position', $position, time()-3600*24*30, "/");
  unset($_COOKIE['position']);
  echo true;
?>
