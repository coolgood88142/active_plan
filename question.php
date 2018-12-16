<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <script src="./assets/js/popper.min.js"></script>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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

  .more-less {
		float: right;
		color: #212121;
  }

 </style>
  <body>
  <div id="navbar"></div>
  <div class="jumbotron container bg-white side-collapse-container-left">
    <form action="question.php" name="showForm" method="post">
        <div class="row">
            <div class="col-md-12" style="top: 50px;">
                <h2 id="title" class="text-center text-dark font-weight-bold">Q&A</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>

                <div class="accordion" id="accordionExample">
                  <?php foreach($quertsion as $key => $value){?>
                  <div class="card">
                    <div class="card-header" id="heading<?=$value['qo_order']?>">
                      <h5 class="mb-0">
                        <div class="row justify-content-center align-items-center">
                          <div class="col">
                              <button class="btn btn-light font-weight-bold collapsed" type="button" data-toggle="collapse" data-target="#collapse<?=$value['qo_order']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                                <?=$value['qu_question']?>
                              </button>
                          </div>
                          <div class="col">
                            <i class="more-less glyphicon glyphicon-plus"></i>
                          </div>
                        </div>
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

    function toggleIcon(e) {
      $(e.target).
      prev('.card-header').
      find(".more-less").
      toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.accordion').on('hidden.bs.collapse', toggleIcon);
    $('.accordion').on('shown.bs.collapse', toggleIcon);

    function show(page){
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

