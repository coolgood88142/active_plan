<?php
    session_start();
    include("mysql.php");

    // $sql = "CREATE TABLE user()
    //     us_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     us_account VARCHAR(30) NOT NULL,
    //     us_password VARCHAR(60) NOT NULL,
    //     us_name NVARCHAR(30) NOT NULL,
    //     us_gender VARCHAR(11) NOT NULL,
    //     us_admin VARCHAR(11) NOT NULL,
    //     us_status INT(11) NOT NULL,
    //     us_email VARCHAR(30) NOT NULL,
    //     us_last_login TIMESTAMP,
    //     us_updatedate TIMESTAMP
    //     )";

    // $sql = "CREATE TABLE plan_acname(
    //     pn_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     pn_ptid INT(6) NOT NULL,
    //     pn_acid INT(6) NOT NULL,
    //     pn_acname NVARCHAR(30) NOT NULL,
    //     pn_updatedate TIMESTAMP
    //     )";

    // $sql = "CREATE TABLE time_types(
    //     ty_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     ty_type INT(6) NOT NULL,
    //     ty_name NVARCHAR(30) NOT NULL,
    //     ty_updatedate TIMESTAMP
    //     )";

    // $sql = "INSERT INTO activity (ac_type, ac_name, ac_weather, ac_drive, ac_carry, ac_spend, ac_hours)
    // VALUES (3, '上課','不拘',2,'錢包、筆記型電腦',1000,2)";

    // $sql = "INSERT INTO plan_trip (pt_acid, pt_name, pt_hours, pt_date, pt_usid,pt_usname,pt_status)
    // VALUES (12, '指導課程', 5,'2018-08-20',8,'使用者',1  )
    // ,(5, '指導課程', 5,'2018-08-20',8,'使用者',1  )";

    //  $sql = "INSERT INTO plan_acname (pn_ptid, pn_acid, pn_acname)
    // VALUES (25, 12, '上課')
    // ,(25, 5, '吃飯')
    // ,(29, 2, '保齡球')
    // ,(29, 10, '兒童樂園')
    // ,(40, 2, '保齡球')
    // ,(43, 10, '兒童樂園')
    // ,(43, 1, '籃球')
    // ,(47, 12, '上課')
    // ,(47, 2, '保齡球')
    // ,(47, 12, '上課')
    // ,(54, 2, '保齡球')";

    //$sql = "INSERT INTO time_types (ty_type, ty_name)
    //VALUES (5, '早午')";

    // $sql = "CREATE TABLE activity_weather(
    //      aw_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //      aw_type INT(6) NOT NULL,
    //      aw_name NVARCHAR(30) NOT NULL,
    //      aw_updatedate TIMESTAMP
    //      )";

    $sql = "INSERT INTO activity_weather (aw_type, aw_name)
    VALUES (1, '晴天')
    ,(2, '陰天')
    ,(3, '雨天')
    ,(4, '不拘')
    ,(5, '晴天、陰天')";


    $conn->exec($sql);
    $conn=null;
    echo "建立成功";
?>