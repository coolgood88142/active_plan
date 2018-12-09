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
    font-family:'微軟正黑體';
  }
  .container{
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }
  @media screen and (max-width: 768px) {
    .jumbotron,.btn{
      font-size:14px;
    }
    #title{
      font-size:28px;
    }
  }
  [data-toggle="collapse"] .fa:before {  
  content: "\f139";
}

[data-toggle="collapse"].collapsed .fa:before {
  content: "\f13a";
}
 </style>
  <body>
  <div id="navbar"></div>
  <div class="jumbotron container bg-Light side-collapse-container-left">
    <form action="question.php" name="showForm" method="post">
        <div class="row">
            <div class="col-md-12" style="top: 20px;">
                <h2 id="title" class="text-center text-dark font-weight-bold">Q&A</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                <div id="button"></div>
                <br/><br/>

                <div class="accordion" id="accordionExample">
                  <?php foreach($quertsion as $key => $value){?>
                  <div class="card">
                    <div class="card-header" id="heading<?=$value['qo_order']?>">
                      <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?=$value['qo_order']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                          <i class="fa" aria-hidden="true"></i>
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
            </div>
        </div>
    </form> 
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

