<?php
if (!isset($_COOKIE['login']) || !isset($_COOKIE['member'])) {
  echo '<script>alert("Login terlebih dahulu"); window.location.href = "../../"; </script>';
}

$idMember = $_COOKIE['member'];
$query = mysqli_query($conn, "SELECT * FROM `members` WHERE member = $idMember");
$response = mysqli_fetch_assoc($query);