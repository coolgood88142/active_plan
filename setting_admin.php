<html>
  <head>
    <title>規劃行程系統</title>
  </head>
<?php include("link.php");?>
<link rel="stylesheet" href="./assets/css/myStyle.css">
<?php session_start();
    $islogin=false;$us_admin = "";
    include("checklogin.php");
    include("mysql.php");
    if($islogin){
        if(isset($_SESSION["us_admin"])){
            $us_admin = $_SESSION['us_admin'];
            include("select_setting.php");
        }
    }else{
        exit;
    }

 ?>
  <body>
    <style>
        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
        @media screen and (max-width: 768px) {
            .jumbotron,.btn{
                font-size:14px;
            }
            #title{
                font-size:28px;
            }
            #addplans{
                display: none;
            }
        }
    </style>
    <div id="navbar"></div>
    <div class="jumbotron container bg-white side-collapse-container-left"> 
        <form name="showForm" method="post">
                <div class="col-md-12 col-from">
                    <h2 id="title" class="text-center text-dark font-weight-bold" style="margin-bottom:20px;">設定</h2>
                    <input type="hidden" name="admin" value="<?=$us_admin?>"/>
                    
                    <div style="text-align:right">
                        <img src="./assets/images/add.png" alt="" id="img" name="img" class="img-thumbnail d-md-none" onClick="add_account()">
                        <input type="button" class="btn btn-primary  d-none d-md-inline d-sm-none" id="addplans" name="addplans" value="新增" onClick="add_account()"/>
                    </div><br/>
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td style="width: 75px;"></td>
                                <td>使用者名稱</td>
                                <td style="width:70px;">編輯設定</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($setting as $key => $value) {
                            ?>
                            <tr>
                                <td class=" details-control"></td>
                                <td class="us_name">
                                    <?php echo $value["us_name"]?>
                                </td>
                                <td style="text-align:center;">
                                    <input type="button" class="btn btn-primary" value="編輯" onClick="edit(this)"/>
                                    <input type="hidden" name="us_name" value="<?=$value["us_name"]?>"/>
                                    <input type="hidden" name="us_account" value="<?=$value["us_account"]?>"/>
                                    <input type="hidden" name="us_gender" value="<?=$value["us_gender"]?>"/>
                                    <input type="hidden" name="us_email" value="<?=$value["us_email"]?>"/>
                                    <input type="hidden" name="us_status" value="<?=$value["us_status"]?>"/>
                                    <input type="hidden" name="us_headshot_path" value="<?=$value["us_headshot_path"]?>"/>
                                </td>
                            </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
        </form>
    </div>
    <form action="setting.php" name="submitForm" method="post">
        <input type="hidden" name="us_name" />            
        <input type="hidden" name="us_account" />
        <input type="hidden" name="us_gender" />
        <input type="hidden" name="us_email" />   
        <input type="hidden" name="us_status" />
        <input type="hidden" name="us_headshot_path" />        
    </form>
    <form action="setting.php" name="addForm" method="post">
        <input type="hidden" name="add_account" value="true"/>   
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $('#example').DataTable(datatable_language());
        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = $('#example').DataTable().row( tr );
 
            var us_account = $(tr).find("td input[name='us_account']").val();
            var us_gender = $(tr).find("td input[name='us_gender']").val();
            var us_email = $(tr).find("td input[name='us_email']").val();
            var us_status = $(tr).find("td input[name='us_status']").val();
            var us_headshot_path = $(tr).find("td input[name='us_headshot_path']").val();
            us_headshot_path = us_headshot_path.replace("/assets/images/upload_file/","");

            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child( format(us_account,us_gender,us_email,us_status,us_headshot_path) ).show();
                tr.addClass('shown');
            }
        } );
    } );

    function format (us_account,us_gender,us_email,us_status,us_headshot_path) {
    var nodata="未填寫";
    if(us_gender==null || us_gender=="" || us_gender==undefined){
        us_gender=nodata;
    }else if(us_gender=="R"){
        us_gender="男";
    }else if(us_gender=="S"){
        us_gender="女";
    }

    if(us_email==null || us_email=="" || us_email==undefined){
        us_email=nodata;
    }

    if(us_status=="1"){
        us_status = "正常";
    }else if(us_status=="2"){
        us_status = "停用";
    }

    if(us_headshot_path==null || us_headshot_path==""){
        us_headshot_path = "無大頭照";
    }

    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>帳號</td>'+
            '<td>'+us_account+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>性別</td>'+
            '<td>'+us_gender+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>電子信箱</td>'+
            '<td>'+us_email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>狀態</td>'+
            '<td>'+us_status+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>狀態</td>'+
            '<td>'+us_status+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>大頭照檔名</td>'+
            '<td>'+us_headshot_path+'</td>'+
        '</tr>'+
    '</table>';
    }

    function edit(obj){
        var tr = $(obj).closest('tr');
        var us_name = $(tr).find("td input[name='us_name']").val();
        var us_account = $(tr).find("td input[name='us_account']").val();
        var us_gender = $(tr).find("td input[name='us_gender']").val();
        var us_email = $(tr).find("td input[name='us_email']").val();
        var us_status = $(tr).find("td input[name='us_status']").val();
        var us_headshot_path = $(tr).find("td input[name='us_headshot_path']").val();

        var from = $("form[name='submitForm']");
        $(from).find("input[name='us_name']").val(us_name);
        $(from).find("input[name='us_account']").val(us_account);
        $(from).find("input[name='us_gender']").val(us_gender);
        $(from).find("input[name='us_email']").val(us_email);
        $(from).find("input[name='us_status']").val(us_status);
        $(from).find("input[name='us_headshot_path']").val(us_headshot_path);
        $(from).submit();
    }

    function add_account(){
        document.addForm.submit();
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

