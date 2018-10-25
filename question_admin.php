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

        <button type="button" id="insert" class="btn btn-primary" onClick="edit('insert',null)">新增Q&A</button><br/><br/>
        <div class="accordion" id="select_data">
          <?php foreach($quertsion as $key => $value){?>
          <div class="card">
            <div class="card-header" id="heading<?=$value['qo_order']?>">
              <h5 class="mb-0">
                <input type="checkbox" id="isDelete">
                <button type="button" class="btn btn-primary" onClick="edit('update',this)">編輯</button>
                <button class="btn btn-link" type="button"  id="question_data" data-toggle="collapse" data-target="#collapse<?=$value['qo_order']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                  <?=$value['qu_question']?>
                </button>
              </h5>
            </div>

            <div id="collapse<?=$value['qo_order']?>" class="collapse" aria-labelledby="heading<?=$value['qo_order']?>" data-parent="#select_data">
              <div class="card-body" id="answer_data">
                <?=$value['qu_answer']?>
              </div>
            </div>
          </div>
          <?php }?>
        </div>

        <button type="button" id="return" class="btn btn-primary" onClick="getSelectData()">返回</button>
        <button type="button" id="storage" class="btn btn-primary" onClick="Data_Processing()">儲存</button><br/><br/>
        <input type="hidden" id="isStatus" value="">
        <div class="accordion" id="edit_data">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="qu_question">問題</span>
            </div>
            <input type="text" id="question" class="form-control" aria-label="question" aria-describedby="qu_question" value="">
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="qu_answer">答案</span>
            </div>
            <input type="text" id="answer" class="form-control" aria-label="answer" aria-describedby="qu_answer" value="">
          </div>
        </div>   
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        $("#storage").hide();
        $("#return").hide();
        $("#edit_data").hide();
    });

    function edit(status,obj){
      if(status=="insert" || status=="update"){
        $("input[name='status']").val(status);
        $("#storage").show();
        $("#return").show();
        $("#edit_data").show();
        $("#insert").hide();
        $("#select_data").hide();

        if(status=="update"){
          var div = $(obj).closest("div[class='card']");
          var question = $(div).find("#question_data").text().trim();
          var answer = $(div).find("#answer_data").text().trim();
          $("#question").val(question);
          $("#answer").val(answer);
        }

        $("#isStatus").val(status);
      }
    }

    function getSelectData(){
      $("#insert").show();
      $("#select_data").show();
      $("#storage").hide();
      $("#return").hide();
      $("#edit_data").hide();

      $("#question").val('');
      $("#answer").val('');
      $("input[name='status']").val('');
    }

    function Data_Processing(){
      var isStatus = $("#isStatus").val();
      var question = $("#question").val();
      var answer = $("#answer").val();
      var data = {
          'isStatus': isStatus, 
          'question': question,
          'answer': answer
        };
        
      $.ajax({
        url: "select_question.php",
        type: "POST",
        async: true, 
        dataType: "json",
        data: data, 
        success: function(info){
            if(chart_type=='1'){
              acivity_name(info);
            }else if(chart_type=='2'){
              acivity_type(info);
            }else if(chart_type=='3'){
              time_type(info);
            }
        },
        error:function(xhr, status, error){
          alert(xhr.statusText);
        }
      });
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && (page=="setting" || page=="question")){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

