<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php include("link.php");?>
<?php session_start();
    $islogin=false;$us_admin = "";
    include("checklogin.php");
    include("mysql.php");
    if($islogin){
        if(isset($_SESSION["us_admin"])){
            $us_admin = $_SESSION['us_admin'];
            include("select_activity.php"); 
        }
    }else{
        exit;
    }
 ?>
  <style>
   .vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center; 
}

.jumbotron{
  height:100%;
  width:100%;
  font-family:'微軟正黑體';
}

#example2 thead td {
  background: url("./assets/images/background.png");
  color: white;
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
 </style>
  <body>
  <div id="navbar"></div>
  <div class="jumbotron container bg-Light side-collapse-container-left">
    <form name="showForm" method="post">
        <div class="row">
            <div class="col-md-12" style="top: 20px;">
                <h2 id="title" class="text-center text-dark font-weight-bold">活動類型</h2>
                <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                <div style="text-align:right">
                    <input type="button" style="display:none;" class="btn btn-primary" name="add_type" value="新增" onClick="add_timetype()"/>
                </div>
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>序號</td>
                            <td>活動類型</td>
                            <?php
                                if($us_admin=='Y'){                
                            ?>
                                <td>編輯設定</td>
                            <?php
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($active_type as $key => $type) {
                        ?>
                        <tr>
                            <td class="type_id" >
                                <?php echo $type["type_id"]?>
                            </td>
                            <td class="name" >
                                <?php echo $type["name"]?>
                            </td>
                            <?php
                                if($us_admin=='Y'){                
                            ?>
                                <td class="type_edit">
                                    <input type="button" class="btn btn-primary" value="編輯" onClick="edit(this)"/>
                                </td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php 
                            }
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
                <div class="row">
                    <input type="button" style="display:none;" class="btn btn-primary" name="backtype" value="回上一頁" onClick="back_timetype()"/>
                </div><br/>
                <div class="form-group row timetypes" style="display:none;">
                    <label class="col-sm-2 control-label" for="add_typename">活動類型:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="add_typename" value="">
                        <input type="hidden" name="add_typeid" value="" >
                    </div>
                </div>
                <div class="row">
                    <input type="button" style="display:none;" class="btn btn-primary" name="addactivity" value="新增" onClick="insert()" />
                    <input type="button" style="display:none;" class="btn btn-primary" name="up_submit" value="儲存" onClick="update()" />
                    <input type="hidden" name="add_timetypes" />
                    <input type="hidden" name="up_timetypes" />
                </div>
            </div>
        </div>
    </form>
  </div>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $('#example2').DataTable(datatable_language());
        if($("input[name='admin']").val()=="Y"){
            $("input[name='add_type']").show();

        }
    } );

    function go_plan(){
        var objName = "",objType = "",objHour = "",objSpend = "";
        $("input[name='add']:checked").each(function(){
            var obj = $(this).closest("tr");
            objName = objName + obj.find(".ac_name").text().trim() + ",";
            objType = objType + obj.find(".ac_type").text().trim() + ",";
            objHour = objHour + obj.find("select[name='hour']").val() + ",";
            objSpend = objSpend + obj.find("input[name='spend']").val() + ","; 
        });
        objName = objName.substring(0, objName.length-1);
        objType = objType.substring(0, objType.length-1);
        objHour = objHour.substring(0, objHour.length-1);
        objSpend = objSpend.substring(0, objSpend.length-1);

        $("input[name='objName']").val(objName);
        $("input[name='objType']").val(objType);
        $("input[name='objHour']").val(objHour);
        $("input[name='objSpend']").val(objSpend);

        document.showForm.action="plan.php"; 
        document.showForm.submit();
    }

    function add_timetype(){
        $('#example2_wrapper').hide()
        $("input[name='add']").hide();
        $("input[name='show_addtype']").hide();
        $("input[name='add_type']").hide();
        $("input[name='show_add']").hide();
        $("input[name='backtype']").show();
        $(".timetypes").show();
        $("input[name='add_typename']").show();
        $("input[name='addactivity']").show();
    }

    function back_timetype(){
        $('#example2_wrapper').show()
        $("input[name='add_type']").show();
        $("input[name='show_add']").show();
        $("input[name='backpage']").hide();
        $("input[name='backtype']").hide();
        $(".timetypes").hide();
        $("input[name='addactivity']").hide();
        $("input[name='up_submit']").hide();
        $("input[name='add_typename']").val('');
    }

    function insert(){
        var add_typename = $("input[name='add_typename']").val();
        if($(".timetypes").is(":visible")){
            if(add_typename==""){
                return alert("請輸入活動類型!");
            }
            $("input[name='add_timetypes']").val('Y');
        }

        document.showForm.action="insert.php"; 
        document.showForm.submit();
    }

    function edit(obj){
        if($('#example2_wrapper').is(':visible')){
            var tr = $(obj).closest('tr');
            var type_id = $(tr).find(".type_id").text().trim();
            var name = $(tr).find(".name").text().trim();
            
            $("input[name='add_typeid']").val(type_id);
            $("input[name='add_typename']").val(name);

            add_timetype();
            $("input[name='up_timetypes']").val('Y');
            $("input[name='addactivity']").hide();
            $("input[name='up_submit']").show();
        }
    }

    function update(){
        var add_typename = $("input[name='add_typename']");
        if($("input[name='up_timetypes']").val()=='Y'){
            if(add_typename==""){
                return alert("請輸入活動類型!");
            }
        }

        document.showForm.action="update_activity.php"; 
        document.showForm.submit();
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

