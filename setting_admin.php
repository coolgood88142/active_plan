<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <!-- jQuery v1.9.1 -->
<script src="jquery-3.3.1.js"></script>
<!-- DataTables v1.10.16 -->
<link href="jquery.dataTables.min.css" rel="stylesheet" />
<script src="jquery.dataTables.min.js"></script>
<?php session_start();
    include("mysql.php");

    $us_admin = $_SESSION['us_admin'];
    if(!empty($us_admin)){
        include("select_setting.php"); 
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
    </style>
    
    <form name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>設定</H2>
        <br/><br/>
        <input type="button" name="addplans" value="新增帳號" onClick="add_account()"/>
        <table id="example">
	        <thead>
                <tr>
                    <td bgcolor="#00FFFF"></td>
                    <td bgcolor="#00FFFF">使用者名稱</td>
                    <td bgcolor="#00FFFF">編輯設定</td>
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
                    <td>
                        <input type="button" value="編輯" onClick="edit(this)"/>
                        <input type="hidden" name="us_name" value="<?=$value["us_name"]?>"/>
                        <input type="hidden" name="us_account" value="<?=$value["us_account"]?>"/>
                        <input type="hidden" name="us_gender" value="<?=$value["us_gender"]?>"/>
                        <input type="hidden" name="us_email" value="<?=$value["us_email"]?>"/>
                        <input type="hidden" name="us_status" value="<?=$value["us_status"]?>"/>
                    </td>
                </tr>
                <?php 
                    }
                ?>
	        </tbody>
            <tfoot>
            </tfoot>
        </table>   
    </form>
    <form action="setting.php" name="submitForm" method="post">
        <input type="hidden" name="us_name" />            
        <input type="hidden" name="us_account" />
        <input type="hidden" name="us_gender" />
        <input type="hidden" name="us_email" />   
        <input type="hidden" name="us_status" />        
    </form>
    <form action="setting.php" name="addForm" method="post">
        <input type="hidden" name="add_account" value="true"/>   
    </form>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        $('#example').DataTable();
        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = $('#example').DataTable().row( tr );
 
            var us_account = $(tr).find("td input[name='us_account']").val();
            var us_gender = $(tr).find("td input[name='us_gender']").val();
            var us_email = $(tr).find("td input[name='us_email']").val();
            var us_status = $(tr).find("td input[name='us_status']").val();
        
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child( format(us_account,us_gender,us_email,us_status) ).show();
                tr.addClass('shown');
            }
        } );
    } );

    function format (us_account,us_gender,us_email,us_status) {
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
    '</table>';
    }

    function edit(obj){
        var tr = $(obj).closest('tr');
        var us_name = $(tr).find("td input[name='us_name']").val();
        var us_account = $(tr).find("td input[name='us_account']").val();
        var us_gender = $(tr).find("td input[name='us_gender']").val();
        var us_email = $(tr).find("td input[name='us_email']").val();
        var us_status = $(tr).find("td input[name='us_status']").val();

        var from = $("form[name='submitForm']");
        $(from).find("input[name='us_name']").val(us_name);
        $(from).find("input[name='us_account']").val(us_account);
        $(from).find("input[name='us_gender']").val(us_gender);
        $(from).find("input[name='us_email']").val(us_email);
        $(from).find("input[name='us_status']").val(us_status);
        $(from).submit();
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && page!="activity" && page!="sign_out"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }

    function add_account(){
        document.addForm.submit();
    }

   
  </script>
</html>

