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
  #sortable { list-style-type: none; margin: 0; padding: 0;}
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 14px; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
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
    <h2 id="title" class="text-center text-dark font-weight-bold">Q&A排序</h2>
    <form action="question.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <br/><br/>

        <ul class="nav justify-content-end">
          <li><button type="button" id="btn_save" class="btn btn-primary" onClick="Save()">儲存</button></li>
          <li><button type="button" id="btn_save" class="btn btn-primary" onClick="back()">返回</button></li>
        </ul>
        <br/><br/>
                    <div id="sortable">
                    <?php foreach($quertsion as $key => $value){?>
                        <div class="accordion" id="select_data">
                    <div class="card">
                      <div class="card-header" id="heading-<?=$value['qu_id']?>">
                        <h5 class="mb-0">
                          <button class="btn btn-link" type="button"  id="question_data" data-toggle="collapse" data-target="#collapse<?=$value['qu_id']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                            <?=$value['qu_question']?>
                          </button>
                        </h5>
                      </div>
                      <div id="collapse<?=$value['qu_id']?>" class="collapse" aria-labelledby="heading-<?=$value['qu_id']?>" data-parent="#select_data">
                        <div class="card-body" id="answer_data">
                          <?=$value['qu_answer']?>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="orderid[]" value="<?=$value['qu_id']?>"> 
                  </div>
                    <?php }?>
                    </div>
                
    </form>
    </div>
  </div>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        $("#storage").hide();
        $("#return").hide();
        $("#edit_data").hide();
        $(".isorder").hide();
    });

    $(function(){
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });

    function Save(){
      var orderid = "";
      $("input[name='orderid[]']").each(function() {
        orderid = orderid + $(this).val() + ",";
      });
      orderid = orderid.substring(0, orderid.length-1);
      var data = { 
          'isStatus': "all_update", 
          'orderid': orderid
        };
        
        $.ajax({
        url: "select_question.php",
        type: "POST",
        async: true, 
        dataType: "json",
        data: data, 
        success: function(info){
          if(info.success==true){
            back();
          }
        },
        error:function(xhr, status, error){
          alert(xhr.statusText);
        }
      });
    }

    
    function back(){
      document.showForm.action="question_admin.php"; 
      document.showForm.submit();
    }

  </script>
</html>

