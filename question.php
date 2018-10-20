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
    $us_admin = $_SESSION['us_admin']; 
    include("select_question.php");
 ?>
  <body>
    <form action="question.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>Q&A</H2>
        <br/><br/>

        <div id="accordion">
          <?php foreach($quertsion as $key => $value){?>
          <div class="card">
            <div class="card-header" id="heading<?=$value['qo_order']?>">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?=$value['qo_order']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                  <?=$value['qu_question']?>
                </button>
              </h5>
            </div>

            <div id="collapse<?=$value['qo_order']?>" class="collapse" aria-labelledby="heading<?=$value['qo_order']?>" data-parent="#accordion">
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
        if($("input[name='admin']").val()=="Y" && page=="setting"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

