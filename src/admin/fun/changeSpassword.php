<?php

require_once("../../config/database.php");

// 处理表单提交的数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 获取并转义表单数据
  $Sno    = mysqli_real_escape_string($db, $_POST["Sno"]);
  $Spassword  = mysqli_real_escape_string($db, $_POST["Spassword"]);
  // echo $Spassword;
  // echo $Sno;
  // exit();
  //   // 构建 REPLACE 查询语句 // REPLACE会导致原有记录的主键和外键关联被重新创建替换为 UPDATE
  $com = "UPDATE 
            student
          SET 
            Spassword = '$Spassword'
          WHERE 
            Sno = '$Sno';";
  // echo $com;
  // exit();
  $result = mysqli_query($db, $com);

  if ($result) {
    if (mysqli_affected_rows($db) > 0) {
      echo "<script>alert('提示：信息更改成功！');history.go(-1);</script>";
    } else {
      echo "<script>alert('注意：没有找到相应的学号或密码未更改。');history.go(-1);</script>";
    }
  } else {
    echo "<script>alert('SQL错误: " . mysqli_error($db) . "');history.go(-1);</script>";
  }
  mysqli_close($db);
} else {
  echo "<script>alert('无效的请求方式。');history.go(-1);</script>";
}
