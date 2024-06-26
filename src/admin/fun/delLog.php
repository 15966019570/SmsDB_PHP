<?php
//学生无法访问
session_start();
if (!isset($_SESSION["admin"])) {
  header("HTTP/1.1 403 Moved Temporatily");
  header("Location: " . "../");
  exit();
}
if ($_SESSION["limit"] == "student") {
  header("HTTP/1.1 403 Moved Temporatily");
  echo "<script>alert('学生无权限');history.go(-1);</script>";
  header("Location: " . "../");
  exit();
}
?>
<?php

require_once("../../config/database.php");

if (isset($_GET["Sno"])) { // 检查是否通过 GET 方法传递了 'Sno' 参数
  $Sno = mysqli_real_escape_string($db, $_GET["Sno"]);
  // echo $Sno;
  $com = "DELETE FROM awd WHERE Sno='$Sno'";
  $result = mysqli_query($db, $com);

  if ($result) {
    echo "<script>alert('提示：操作成功。');history.go(-1);</script>";
  } else {
    echo "<script>alert('注意：数据未更改！');history.go(-1);</script>";
  }

  mysqli_close($db);
} else {
  echo "<script>alert('错误：缺少必要的参数。');history.go(-1);</script>";
}
