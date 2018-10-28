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

        <ul class="nav navbar-nav pull-right">
          <li><button type="button" id="btn_insert" class="btn btn-primary" onClick="edit('insert',null)">新增Q&A</button></li>
          <li><button type="button" id="btn_delete" class="btn btn-primary" onClick="edit('delete',null)">刪除</button></li>
          <li><button type="button" id="btn_order" class="btn btn-primary" onClick="isOrder()">排序</button></li>
        </ul>
        
        <br/><br/>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th class="isorder" style="text-align:center; vertical-align:middle; width:50px;"></th>
              <th style="text-align:center; vertical-align:middle; width:50px;">刪除</th>
              <th style="text-align:center; vertical-align:middle;">問題</th>
              <th style="text-align:center; vertical-align:middle; width:80px;">編輯</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($quertsion as $key => $value){?>
              <tr>
                <td class="isorder" style="text-align:center; vertical-align:middle;">
                  <img id="order_up" src="./assets/images/icons-up.png" style="width:30px; height:30px;" onClick="change_up(this)">
                  <img id="order_down" src="./assets/images/icons-down.png" style="width:30px; height:30px;" onClick="change_down(this)">
                </td>
                <td style="text-align:center; vertical-align:middle;"><input type="checkbox" id="isDelete"></td>
                <td>
                  <div class="accordion" id="select_data">
                    <div class="card">
                      <div class="card-header" id="heading<?=$value['qu_id']?>">
                        <h5 class="mb-0">
                          <button class="btn btn-link" type="button"  id="question_data" data-toggle="collapse" data-target="#collapse<?=$value['qu_id']?>" aria-expanded="true" aria-controls="collapse<?=$value['qo_order']?>">
                            <?=$value['qu_question']?>
                          </button>
                        </h5>
                      </div>
                      <div id="collapse<?=$value['qu_id']?>" class="collapse" aria-labelledby="heading<?=$value['qu_id']?>" data-parent="#select_data">
                        <div class="card-body" id="answer_data">
                          <?=$value['qu_answer']?>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="order_data" value="<?=$value['qu_id']?>"> 
                  </div>
                  </td>
                  <td style="text-align:center; vertical-align:middle;"><button type="button" class="btn btn-primary" onClick="edit('update',this)">編輯</button></td>
              </tr>
            <?php }?>
          </tbody>
        </table>

        <button type="button" id="return" class="btn btn-primary" onClick="getSelectData()">返回</button>
        <button type="button" id="storage" class="btn btn-primary" onClick="Data_Processing()">儲存</button><br/><br/>
        <input type="hidden" id="isStatus" value="">
        <div class="accordion" id="edit_data">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="qu_question">問題</span>
            </div>
            <textarea id="question"  class="form-control" aria-label="question" aria-describedby="qu_question" rows="3"></textarea>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="qu_answer">答案</span>
            </div>
            <textarea id="answer" class="form-control"  aria-label="answer" aria-describedby="qu_answer" rows="3"></textarea>
          </div>
          <input type="hidden" id="order" value=""> 
          <input type="hidden" id="last_order" value="">
          <input type="hidden" id="this_index" value=""> 
          <input type="hidden" id="last_index" value=""> 
        </div>   
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
      $('#example').DataTable();
        $('#button').load('button.php');
        $("#storage").hide();
        $("#return").hide();
        $("#edit_data").hide();
        $(".isorder").hide();
    });

    function isOrder(){
      if($(".isorder").is(':visible')==true){
        $(".isorder").hide();
      }else{
        $(".isorder").show();
      }
    }

    function change_up(obj){
      var tr = $(obj).closest("tr");
      var prev = $(tr).prev();
      var prev_order = $(prev).find("#order_data").val();
      if(prev_order!="" && prev_order!=null && prev_order!=undefined){
        $("#order").val($(tr).find("#order_data").val());
        $("#last_order").val($(prev).find("#order_data").val());
        $("#this_index").val($(tr).index()+1);
        $("#last_index").val($(prev).index()+1);
        $("#isStatus").val('order');
        Data_Processing();
      }
    }

    function change_down(obj){
      var tr = $(obj).closest("tr");
      var next = $(tr).next();
      var next_order = $(next).find("#order_data").val();
      if(next_order!="" && next_order!=null &&next_order!=undefined){
        $("#order").val($(tr).find("#order_data").val());
        $("#last_order").val($(next).find("#order_data").val());
        $("#this_index").val($(tr).index()+1);
        $("#last_index").val($(next).index()+1);
        $("#isStatus").val('order');
        Data_Processing();
      }
    }

    function edit(status,obj){
      if(status=="insert" || status=="update"){
        $("input[name='status']").val(status);
        $("#storage").show();
        $("#return").show();
        $("#edit_data").show();
        $("#btn_insert").hide();
        $("#btn_delete").hide();
        $("#btn_order").hide();
        $('#example_wrapper').hide();

        if(status=="update"){
          var tr = $(obj).closest("tr");
          var question = $(tr).find("#question_data").text().trim();
          var answer = $(tr).find("#answer_data").text().trim();
          var order = $(tr).find("#order_data").val();
          $("#question").val(question);
          $("#answer").val(answer);
          $("#order").val(order);
        }
        $("#isStatus").val(status);
      }

      if(status=="delete"){
          var orders = ""; 
          $("input[id='isDelete']:checked").each(function(){
            var obj = $(this).closest("tr");
            orders = orders + $(obj).find("#order_data").val() + ",";
          });
          
          if(orders!=""){
            $("#order").val(orders.substring(0, orders.length-1));
            $("#isStatus").val(status);
            Data_Processing();
          }else{
            alert("請至少勾選一個刪除");
          }
        }
    }

    function getSelectData(){
      $("#btn_insert").show();
      $("#btn_delete").show();
      $("#btn_order").show();
      $('#example_wrapper').show();
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
      var order = $("#order").val();
      var last_order = $("#last_order").val();
      var this_index = $("#this_index").val();
      var last_index = $("#last_index").val();
      
      var data = {
          'isStatus': isStatus, 
          'question': question,
          'answer': answer,
          'order': order,
          'last_order': last_order,
          'this_index': this_index,
          'last_index': last_index
        };
        
        $.ajax({
        url: "select_question.php",
        type: "POST",
        async: true, 
        dataType: "json",
        data: data, 
        success: function(info){
          if(info.success==true){
            show('question');
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

