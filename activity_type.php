<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php include("link.php");?>
<script src="./assets/js/main.js"></script>
<link rel="stylesheet" href="./assets/css/main.css">
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

.img-thumbnail{
    width:48px;
    height:48px;
}

.wrap-contact100{
    background: #DDDDDD;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.wrap-input100{
    border: 1px solid #e6e6e6;
    border-radius: 13px;
    padding: 10px 30px 9px 22px;
    margin-bottom: 20px;
    position: relative;
    font-family: '微軟正黑體';
}
.label-input100{
    font-size: 15px;
}
.container-contact100-form-btn{
    justify-content:start;
}
.nav-link{
    font-size:1rem;
}

@media screen and (max-width: 768px) {
    .jumbotron,.btn,.form-control{
        font-size:14px;
    }
    #title{
        font-size:28px;
    }
}
 </style>
  <body>
  <div id="navbar"></div>
  <div class="jumbotron container bg-white side-collapse-container-left">
    <form name="showForm" method="post">
        <div class="col-md-12" style="top: 50px;">
            <h2 id="title" class="text-center font-weight-bold" style="margin-bottom:20px;">活動類型</h2>
            <input type="hidden" name="admin" value="<?=$us_admin?>"/>
            <div id="addbutton" style="text-align:right">
                <img src="./assets/images/add.png" alt="" id="img" name="img" class="img-thumbnail d-md-none" style="margin-bottom:20px;" onClick="add_timetype()">
                <input type="button" class="btn btn-primary d-none d-md-inline d-sm-none" style="display:none; margin-bottom:20px;" id="add_type" name="add_type" value="新增" onClick="add_timetype()"/>
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
            <div class="wrap-contact100" style="display:none; width:100%;">
                <div class="container-contact100-form-btn">
                    <div class="row">
                        <div class="col-sm-4 col-md-2">
                            <input type="button" style="display:none; margin-bottom:20px;" class="btn btn-primary" name="backtype" value="回上一頁" onClick="back_timetype()"/>
                        </div>
                    </div>
                </div>
                <div class="wrap-input100 bg1 rs1-wrap-input100 timetypes" style="display:none;">
                    <span>
                        <label style="color:red;">*</label>活動類型：
                    </span>
                    <input class="input100" type="text" name="add_typeid" placeholder="輸入活動類型!">
                </div>
                <div class="container-contact100-form-btn">
                    <div class="row">
                        <div class="col-sm-4 col-md-2">
                            <input type="button" style="display:none;" class="btn btn-primary" name="addactivity" value="新增" onClick="insert()" />
                            <input type="button" style="display:none;" class="btn btn-primary" name="up_submit" value="儲存" onClick="update()" />
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="add_timetypes" />
            <input type="hidden" name="up_timetypes" />
            <input type="hidden" name="Responsive_Button" />
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

    function add_timetype(){
        $('#example2_wrapper').hide()
        $("input[name='show_addtype']").hide();
        $("input[name='add_type']").hide();
        $("input[name='show_add']").hide();
        $("input[name='backtype']").show();
        $(".timetypes").show();
        $("input[name='add_typename']").show();
        $("input[name='addactivity']").show();
        $(".wrap-contact100").show();

        if($("#add_type").is(":visible")){
            $("#addbutton").css("display", "none");
            $("input[name='Responsive_Button']").val(false);
        }else if($("#img").is(":visible")){
            $("#img").css("display", "none");
            $("input[name='Responsive_Button']").val(true);
        }
    }

    function back_timetype(){
        $('#example2_wrapper').show()
        $("input[name='show_add']").show();
        $("input[name='backpage']").hide();
        $("input[name='backtype']").hide();
        $(".timetypes").hide();
        $("input[name='addactivity']").hide();
        $("input[name='up_submit']").hide();
        $("input[name='add_typename']").val('');
        $(".wrap-contact100").hide();

        var Responsive_Button = $("input[name='Responsive_Button']").val();
        if(Responsive_Button == "true"){
            $("#img").show();
        }else{
            $("#add_type").show();
        }
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
  </script>
</html>

