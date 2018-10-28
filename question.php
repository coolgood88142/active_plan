<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<?php session_start();
    include("mysql.php");

    $us_admin = "";
    if(!empty($_COOKIE['us_account'] ) && !empty($_COOKIE['us_password'])) { 
        if(isset($_SESSION["us_admin"])){
          $us_admin = $_SESSION['us_admin'];
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

        <div class="accordion" id="accordionExample">
          <?php foreach($quertsion as $key => $value){?>
          <div class="card">
            <div class="card-header" id="heading<?=$value['qo_order']?>">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?=$value['qo_order']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                  <?=$value['qu_question']?>
                </button>
              </h5>
            </div>

            <div id="collapse<?=$value['qo_order']?>" class="collapse" aria-labelledby="heading<?=$value['qo_order']?>" data-parent="#accordionExample">
              <div class="card-body">
                <?=$value['qu_answer']?>
              </div>
            </div>
          </div>
          <?php }?>
        </div>      
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
    });

    function show(page){
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

