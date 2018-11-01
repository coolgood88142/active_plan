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
  </style>
  <body>
    <form action="question.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <div id="button"></div>
        <H2>Q&A</H2>
        <br/><br/>

        <ul class="nav justify-content-end">
          <li><button type="button" id="btn_save" class="btn btn-primary" onClick="Save()">儲存</button></li>
        </ul>
        
        <br/><br/>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th style="text-align:center; vertical-align:middle;">問題</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>
                    <ul id="sortable">
                    <?php foreach($quertsion as $key => $value){?>
                        <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?=$value['qu_question']?></li>
                    <?php }?>
                    </ul>
                </td>
            </tr>
          </tbody>
        </table>   
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

    $(function(){
        $("#sortable").sortable();
        $("#sortable").disableSelection();
    });
  </script>
</html>

