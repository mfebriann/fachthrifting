<?php
include ('../../db.php');
$action = $_REQUEST["action"];

switch ($action) {
  case "files":
    $fileNameReal = $_FILES['files']['name'];
    $fileSize = $_FILES['files']['size'];
    $fileType = $_FILES['files']['type'];
    $tmpName = $_FILES['files']['tmp_name'];
    $typeCut = strstr($fileType, '/');
    $attachmentHidden = $_POST["files_hidden"];

    $imageExtension = explode('.', $fileNameReal);
    $imageExtension = strtolower(end($imageExtension));
    $fileName = strtolower(explode('.', $fileNameReal)[0]);
    $imagesDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Rian-Folder-Backend/FachThrifting/Website/src/images/products/";
    $newFileName = $fileName . "-" . date("Y.m.d-H.i.s") . ".{$imageExtension}";


    if ($fileSize <= 10000000) {
      $formatType = trim($typeCut, '/');
      $query = mysqli_query($conn, "INSERT INTO `codes` VALUES(NULL, '$fileNameReal', NOW(), '$formatType', '$newFileName')");

      if ($query) {
        $queryGetId = mysqli_query($conn, "SELECT `code` FROM `codes` ORDER BY `code` DESC LIMIT 1");
        $id = mysqli_fetch_assoc($queryGetId)["code"];
        if ($attachmentHidden !== '') {
          $files = $attachmentHidden . ',' . $id;
        } else {
          $files = $id;
        }

        move_uploaded_file($tmpName, $imagesDirectory . $newFileName);

        echo json_encode(
          array(
            "id" => $id,
            "files" => $files,
          )
        );
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    }
    break;

  case 'delDoc':
    $transactionId = $_REQUEST["transactionId"];
    $notAddPage = $_REQUEST["notAddPage"];
    $delId = $_REQUEST["delId"]; // As deleted
    $arrCode = $_REQUEST["arrCode"]; // As container from deleted array
    $integer = $_REQUEST["integer"];
    $reArrCode = (explode(",", $arrCode));
    $newArrCode = array_diff($reArrCode, array($delId));

    if ($notAddPage == "true") {
      $images = count($newArrCode) === 0 ? "NULL" : "'" . implode(',', $newArrCode) . "'";
      mysqli_query($conn, "UPDATE `transactions` SET images = $images WHERE transaction = $transactionId");
    }

    if ($integer == 'yes') {
      $listArrCode = intval($newArrCode);
    } else {
      $listArrCode = implode(',', $newArrCode);
    }

    echo json_encode(
      array(
        "success" => "success",
        "listArray" => $listArrCode,
      )
    );
    break;
}
?>