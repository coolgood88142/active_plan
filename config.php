<?php
$servername = "localhost";
$username = "root";
$password = "";
// $dbname= "mydb";
 
//mysqli 連線
// 创建连接
// $conn = new mysqli($servername, $username, $password ,$dbname);
 
// // 检测连接
// if ($conn->connect_error) {
//     die("连接失败: " . $conn->connect_error);
// } 
// echo "连接成功";

// 创建数据库
// $sql = "CREATE DATABASE myDB";
// if ($conn->query($sql) === TRUE) {
//     echo "数据库创建成功";
// } else {
//     echo "Error creating database: " . $conn->error;
// }


// 使用 sql 创建数据表
// $sql = "CREATE TABLE MyGuests (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table MyGuests created successfully";
// } else {
//     echo "创建数据表错误: " . $conn->error;
// }

// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";
// $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('Mary', 'Moe', 'mary@example.com');";
// $sql .= "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('Julie', 'Dooley', 'julie@example.com')";

// if ($conn->multi_query($sql) === TRUE) {
//     echo "新记录插入成功";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// if ($conn->query($sql) === TRUE) {
//     echo "新记录插入成功";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $result = mysqli_query($conn,"SELECT * FROM MyGuests
// WHERE firstname='John'");

// while($row = mysqli_fetch_array($result))
// {
//     echo $row['firstname'] . " " . $row['lastname'];
//     echo "<br>";
// }

// $conn->close();

//------------------------------------------------------------------------------------

$dbname= "plan";
// // PDO連線
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    echo "连接成功"; 

// 	// 设置 PDO 错误模式为异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "CREATE DATABASE myDBPDO";

// 	// // 使用 sql 创建数据表
// 	// $sql = "CREATE TABLE MyGuests (
// 	// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// 	// firstname VARCHAR(30) NOT NULL,
// 	// lastname VARCHAR(30) NOT NULL,
// 	// email VARCHAR(50),
// 	// reg_date TIMESTAMP
// 	// )";

	// $sql = "CREATE TABLE user (
    // us_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    // us_account NVARCHAR(15) NOT NULL,
	// us_name VARCHAR(30) NOT NULL,
	// us_password VARCHAR(60) NOT NULL,
	// us_gender VARCHAR(1) NOT NULL,
    // us_email NVARCHAR(30) NOT NULL,
    // us_isadmin VARCHAR(1) NOT NULL,
	// us_updatedate TIMESTAMP
	// )";

// 	// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
//  //    VALUES ('John', 'Doe', 'john@example.com')";
    $pass = '0000';
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    // $length = strlen( $hash );

    // $hash = str_replace('/','\\',$hash);
  
    // $sql = "INSERT INTO user (us_account, us_name, us_password, us_gender, us_email, us_isadmin)
    //     VALUES ('admin0000','系統管理員', '$hash', '','','Y')";

    

    // echo $sql;
//     // 使用 exec() ，因为没有结果返回
    $as = '0000';
    $sql = "select * from user where us_id='1'";
    // $conn->exec($sql);
    $query = $conn->query($sql);
    $datalist = $query->fetchAll();
    foreach($datalist as $row){
        $pass = $row['us_password'];
        if(password_verify($as,$pass)){
            echo "密碼正確";
        }else{
            echo "密碼錯誤";
         }
    }
    // $result = mysqli_query($conn, $sql);
    // if(mysqli_num_rows($result)>0){
    //     while($row = mysqli_fetch_assoc($result)){
    //         $as = '0000';
    //         $pass = $row["us_password"];
    //         if(password_verify($as,$pass)){
    //             echo "密碼正確";
    //         }else{
    //             echo "密碼錯誤";
    //         }
    //     }
    // }
    
    // if(password_verify($password,$hash)){
    //     echo "密碼正確";
    // }else{
    //     echo "密碼錯誤";
    // }

//     // 开始事务
//     // $conn->beginTransaction();
//     // // SQL 语句
//     // $conn->exec("INSERT INTO MyGuests (firstname, lastname, email) 
//     // VALUES ('John', 'Doe', 'john@example.com')");
//     // $conn->exec("INSERT INTO MyGuests (firstname, lastname, email) 
//     // VALUES ('Mary', 'Moe', 'mary@example.com')");
//     // $conn->exec("INSERT INTO MyGuests (firstname, lastname, email) 
//     // VALUES ('Julie', 'Dooley', 'julie@example.com')");
 
//     // // 提交事务
//     // $conn->commit();

//     // echo "数据库创建成功<br>";

}
catch(PDOException $e)
{
	// $conn->rollback();
    echo $e->getMessage();
}
$conn=null;




?>