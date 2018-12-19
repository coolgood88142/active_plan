<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
  <script src="./assets/js/popper.min.js"></script>
  <script src="./assets/js/main.js"></script>
  <link rel="stylesheet" href="./assets/css/main.css">
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

  .panel-group .panel {
    border-radius: 0;
    box-shadow: none;
    border-color: #EEEEEE;
  }

  .panel-default > .panel-heading {
		padding: 0;
		border-radius: 0;
		color: #212121;
		background-color: #FAFAFA;
		border-color: #EEEEEE;
	}

  .wrap-contact100{
      width:100%;
      background: #DDDDDD;
  }

  a.titletext{
    font-size: 18px;
      font-family:'微軟正黑體';
  }
  
  .panel-body {
		font-size: 16px;
    font-family:'微軟正黑體';
	}

  .panel-title > a {
		display: block;
		padding: 15px;
		text-decoration: none;
	}

  .panel-default > .panel-heading + .panel-collapse > .panel-body {
		border-top-color: #EEEEEE;
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

                <div class="wrap-contact100">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach($quertsion as $key => $value){?>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading<?=$value['qo_order']?>">
                          <h4 class="panel-title font-weight-bold">
                            <a class="titletext" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$value['qo_order']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                              <i class="more-less glyphicon glyphicon-plus"></i>
                              <?=$value['qu_question']?>
                            </a>
                          </h4>
                        </div>

                        <div id="collapse<?=$value['qo_order']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$value['qo_order']?>">
                          <div class="panel-body font-weight-bold">
                            <?=$value['qu_answer']?>
                          </div>
                        </div>
                    </div>
                    <?php }?>
                  </div>
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
        $(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

    function show(page){
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

