<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <script src="./assets/js/popper.min.js"></script> 
<?php session_start();
    $islogin=false;$us_admin = "";
    include("checklogin.php");
    include("mysql.php");
    if($islogin){
        if(isset($_SESSION["us_admin"])){
            $us_admin = $_SESSION['us_admin'];
            include("select_question.php");
        }
    }else{
        exit;
    }
 ?>
 <style>
  .vertical-center {
    min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
    display: flex;
    align-items: center; 
  }
  .jumbotron{
    height:100%;
    width:100%;
  }
 </style>
  <body>
  <div class="jumbotron vertical-center bg-Light">
    <div class="container">
    <h2 id="title" class="text-center text-dark font-weight-bold">Q&A</h2>
    <form action="question.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
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
    </div>
  </div>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
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

