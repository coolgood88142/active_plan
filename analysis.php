<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  
<?php include("link.php");?>
<script language="javascript" src="./assets/js/jquery.min.js"></script>
<script language="javascript" src="./assets/js/moment.js"></script>
<script language="javascript" src="./assets/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="./assets/css/bootstrap-datetimepicker.min.css">
<script src="./assets/js/zh-cn.js"></script>
<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
<script src="./assets/js/highcharts.js"></script>
<script src="./assets/js/highcharts-3d.js"></script>
<script src="./assets/js/series-label.js"></script>
<script src="./assets/js/exporting.js"></script>
<script src="./assets/js/export-data.js"></script>
<script src="./assets/js/wordcloud.js"></script>
<?php session_start();
    $islogin=false;$us_admin = "";
    include("checklogin.php");
    include("mysql.php");
    if($islogin){
        if(isset($_SESSION["us_admin"])){
            $us_admin = $_SESSION['us_admin'];
        }
    }else{
        exit;
    }
 ?>
<style>
  #ac_name,#ac_type {
  min-width: 310px;
  margin: 0 auto
  }
  tspan{
   font-size:20px;
  }
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

/* #title_div{
  position: fixed;
  top: 100px;
} */
</style>
  <body>
  <div class="jumbotron vertical-center">
    <div class="container">
      <div id="navbar"></div>
      <div id="title_div">
        <form action="analysis.php" name="showForm" method="post">
            <p class="h2 text-center text-dark font-weight-bold">活動列表</p>
            <input type="hidden" name="admin" value="<?=$us_admin?>"/>
            
            <input type="button" name="acivity_name" value="活動項目統計表" onClick="show_chart('1')"/>
            <input type="button" name="acivity_type" value="活動類型統計表" onClick="show_chart('2')"/>
            <input type="button" name="time_type"value="時段統計表"  onClick="show_chart('3')"/>
            <br/><br/>

            <div class="container" id="select_date">
              <div class="row justify-content-center align-items-center">
                <div class="col-md-2"><h4 class="text-center">起始日期:</h4></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group date">
                      <input type="text" class="form-control" name="begin_date" >
                        <span class="input-group-addon">
                          <i class="glyphicon glyphicon-th"></i></span>  
                    </div>
                  </div>
                </div>
                <div class="col-md-1"><h4 class="text-center">~</h4></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group date">
                      <input type="text" class="form-control" name="end_date" value="" size="16"  required readonly/>
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <button name="query_data" class="btn btn-info btn-sm" onClick="query_chart()">
                    查詢
                  </button>
                </div>
              </div>
            </div>
            <br/>
            <input type="hidden" name="chart_type" value=""/>
            <div id="ac_name" style="display_none;"></div>
            <div id="ac_type" style="display_none;"></div>
            <div id="ty_type" style="display_none;"></div>
        </form>
      </div>
    </div>
  </div>
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#navbar').load('navbar.php');
        $("#ac_name").show();
        $("input[name='chart_type']").val('1');
        select_chart(true,'1');
        $(".input-group.date").datepicker();
    });
    function openDate(name){
      $(name).datetimepicker({
          format: "yy-mm-dd",
          ignoreReadonly: true,
          language:  'zh-CN',  //日期
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
      });
    }
    
    function query_chart(){
      var chart_type = $("input[name='chart_type']").val();
      select_chart(false,chart_type);
    }
    function show_chart(chart_type){
      $("input[name='begin_date']").val("");
      $("input[name='end_date']").val("");
      $("input[name='chart_type']").val(chart_type);
      
      if(chart_type=='1'){
        $("#ac_name").show();
        $("#ac_type").hide();
        $("#ty_type").hide();
      }else if(chart_type=='2'){
        $("#ac_name").hide();
        $("#ac_type").show();
        $("#ty_type").hide();
      }else if(chart_type=='3'){
        $("#ac_name").hide();
        $("#ac_type").hide();
        $("#ty_type").show();
      }
      select_chart(true,chart_type);
    }
    function acivity_name(obj){
      var activity_text = "";
      if(obj!="" && obj!=undefined){
        activity_text = obj.activity_text;
        if(activity_text==false){
          activity_text = "";
        }
        var lines = activity_text.split(/[,. ]+/g),
        data = Highcharts.reduce(lines, function (arr, word) {
        var obj = Highcharts.find(arr, function (obj) {
          return obj.name === word;
        });
        if (obj) {
          obj.weight += 1;
        } else {
          obj = {
            name: word,
            weight: 1
          };
          arr.push(obj);
        }
          return arr;
        }, []);
        Highcharts.chart('ac_name', {
          series: [{
            type: 'wordcloud',
            data: data,
            name: '數量'
          }],
          title: {
            text: '活動項目統計表'
          }
        }); 
      }
    }
    function acivity_type(obj){
      var name_array ="";month_array ="";month=[];series_array="";month_data=[];month_count="";
      if(obj!="" && obj!=undefined){
        month_count = obj.month;
        for(var i=0;i<month_count.length;i++){
          month.push(parseInt(month_count[i])+"月");
        }
        name_array = obj.name_array;
        month_array = obj.month_array;
        
        var json = "";json_value = "";       
        $.each(month_array, function(index, value){
          var arr = { name: [],data:[] };
            arr.name.push(index);
            for(var i=0;i<value.length;i++){
              arr.data.push(parseInt(value[i]));
            }
            month_data.push(arr);
        });
        series_array = month_data;
        Highcharts.chart('ac_type', {
          title: {
            text: '活動類型統計表'
          },
          xAxis: {
            categories: month
          },
          yAxis: {
            title: {
              text: '數量'
            }
          },
          
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
          },
          plotOptions: {
            series: {
              label: {
                connectorAllowed: false
              },
              pointStart: 0
            }
          },
        series: series_array,
        responsive: {
          rules: [{
            condition: {
            maxWidth: 500
          },
          chartOptions: {
            legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom'
            }
          }
          }]
        }
      });
      }
    }
    function time_type(obj){
      var data_array="";time_array="";time_name="";time_count="";
      if(obj!="" && obj!=undefined){
        time_array = obj.time_array;
        $.each(time_array, function(index, value){
          if(index=="time_name"){
            time_name = time_name + value;
          }else if(index=="time_count"){
            time_count = time_count + value;
          }
        });
        var name_array = time_name.split(",");
        var count_array = time_count.split(",");
        data_array = [];
        if(name_array!="" && name_array!=null && count_array!="" && count_array!=null){
          for(var i=0; i<name_array.length; i++){
            data_array[i] = [String(name_array[i]) ,  parseInt(count_array[i])];
          }
        }
        Highcharts.chart('ty_type', {    
          chart: {
          type: 'pie',
            options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
          }
         },
        title: {
          text: '時段統計表'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
              enabled: true,
              format: '{point.name}'
            }
          }
        },
        series: [{
          type: 'pie',
          name: '時段',
          data: data_array
        }]
        });
      }
    }
    function select_chart(isPreset,chart_type){
      var admin = $("input[name='admin']").val();
      var begin_date = $("input[name='begin_date']").val();
      var end_date = $("input[name='end_date']").val();
      var begin = begin_date.split(/[-. ]+/g);
      var end = end_date.split(/[-. ]+/g);
      var begin_day = parseInt(begin[0] + begin[1] + begin[2]);
      var end_day = parseInt(end[0] + end[1] + end[2]);
      var begin_month = parseInt(begin[0] + begin[1]);
      var end_month = parseInt(end[0] + end[1]);
      var diff_momth = "";
      if(end_month>begin_month){
        diff_momth =  end_day - begin_day;
      }
      if(isPreset==false){
        if(begin_date=="" || end_date==""){
          return alert("請輸入起始年月!");
        }else if(begin_day>end_day){
          return alert("起始日期不可大於結束日期!");
        }else if(diff_momth>10000){
          return alert("查詢日期不可以超過1年!");
        }
      }
      var data = {
          'admin': admin, 
          'chart_type': chart_type,
          'begin_date': begin_date,
          'end_date': end_date,
          'today_year': 'Y'
        };
      $.ajax({
        url: "select_analysis.php",
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