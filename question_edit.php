<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
<?php session_start();
    include("mysql.php");

    $us_admin = "";
    if(isset($_SESSION["us_admin"])) {
      $us_admin = $_SESSION['us_admin'];
      if(!empty($us_admin)){
        include("select_question.php");
      }
    }else{
      echo '<meta http-equiv=REFRESH CONTENT=0;url=login.php>';
    }

 ?>
  <body>
    <form action="question.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>Q&A</H2>
        <br/><br/>

        <button type="button" class="btn btn-primary">儲存</button><br/><br/>
        <div class="accordion" id="accordionExample">
          <?php foreach($quertsion as $key => $value){?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="qu_question">問題</span>
                </div>
                <input type="text" class="form-control" aria-label="quertsion" aria-describedby="qu_question" value="<?=$value['qu_question']?>">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="qu_answer">答案</span>
                </div>
                <input type="text" class="form-control" aria-label="answer" aria-describedby="qu_answer" value="<?=$value['qu_answer']?>">
            </div>
        <?php }?>
        </div>      
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
    });

  </script>
</html>

