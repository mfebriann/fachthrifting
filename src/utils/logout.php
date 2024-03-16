<?php
unset($_COOKIE['login']);
unset($_COOKIE['member']);
setcookie('login', 'false', time() - 3600, '/');
setcookie('member', 'false', time() - 3600, '/');
echo '<script>window.location.href = "../../"; </script>';
exit;