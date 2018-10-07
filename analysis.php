<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <?php include("link.php");?>
<?php session_start();
    include("mysql.php");
    $us_admin = $_SESSION['us_admin'];
    
    $chart_type = "";$begin_date="";$end_date="";$activity_text="";
    $name_array=[];$month_array=[];$time_array=[];
    $namecount="";$monthcount="";$timecount="";
    if(isset($_POST['post_chart_type'])){
        $chart_type = $_POST['post_chart_type'];
    }else if(!empty($us_admin)){
        date_default_timezone_set('Asia/Taipei');
        $today_year = date ("Y");
        include("select_activity.php"); 
    }

    if(isset($_POST['post_begin_date']) && isset($_POST['post_end_date'])){
      $begin_date = $_POST['post_begin_date'];
      $end_date = $_POST['post_end_date'];
    }

    if($chart_type=='1' && isset($_POST['post_activity_text'])){
      $activity_text = $_POST['post_activity_text'];
    }else if($chart_type=='2' && isset($_POST['post_name_array']) && isset($_POST['post_month_array'])){
      $name_array = $_POST['post_name_array'];
      $month_array = $_POST['post_month_array'];
    }else if($chart_type="3" && isset($_POST['post_time_array'])){
      $time_array = json_decode($_POST['post_time_array'], false, 512, JSON_UNESCAPED_UNICODE);
      echo var_dump($time_array);
    }

 ?>
  <body>
    <style>
        #ac_name,#ac_type {
            min-width: 310px;
            margin: 0 auto
        }
        tspan{
          font-size:20px;
        }
    }
    </style>
    <form action="select_activity.php" name="showForm" method="post">
        <input type="hidden" name="admin" value="<?=$us_admin?>"/>
        <input type="hidden" id="post_chart_type" value="<?=$chart_type?>"/>
        <input type="hidden" id="post_begin_date" value="<?=$begin_date?>"/>
        <input type="hidden" id="post_end_date" value="<?=$end_date?>"/>
        <input type="hidden" id="activity_text" value="<?=$activity_text?>"/>
        <div id="button"></div>
        <H2>分析表</H2>
        <br/><br/>
        <input type="button" name="acivity_name" value="活動項目統計表" onClick="show_chart('1')"/>
        <input type="button" name="acivity_type" value="活動類型統計表" onClick="show_chart('2')"/>
        <input type="button" name="time_type"value="時段統計表"  onClick="show_chart('3')"/>
        <br/><br/>
        起始年月: <input type="text" name="begin_date" value="" size="8"/> ~ <input type="text" name="end_date" value="" size="8"/>&nbsp
        <input type="button" name="query_data" value="查詢" onClick="query_chart()"/>
        <input type="hidden" name="chart_type" value=""/>
        <input type="hidden" name="today_year" value="Y" />
        <div id="ac_name" style="display_none;"></div>
        <div id="ac_type" style="display_none;"></div>
        <div id="ty_type" style="display_none; height: 400px"></div>
    </form>  
  </body>
  <script language="JavaScript">
    $(document).ready(function() {
        $('#button').load('button.php');
        acivity_name();
        openDate($("input[name='begin_date']"));
        openDate($("input[name='end_date']"));
        if($("input[name='post_chart_type']").val()!=""){
          var begin_date = $("input[name='post_begin_date']").val();
          var end_date = $("input[name='post_end_date']").val();

          $("input[name='begin_date']").val(begin_date);
          $("input[name='end_date']").val(end_date);
          show_chart($("input[name='post_chart_type']").val());
        }
    });

    function openDate(name){
      $(name).datepicker({
          dateFormat: "yy-mm-dd",
          changeMonth : true,
          changeYear : true,
          showMonthAfterYear : true,
          dayNames : [ "星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六" ],
          dayNamesShort : [ "日", "一", "二", "三", "四", "五", "六" ],
          dayNamesMin : [ "日", "一", "二", "三", "四", "五", "六" ],
          monthNames : [ "1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月","10月", "11月", "12月" ],
          monthNamesShort : [ "1", "2", "3", "4", "5", "6", "7", "8", "9","10", "11", "12" ],
          nextText : "下個月",
          prevText : "上個月"
      });
    }
    
    function query_chart(){
      var from = $("form[name='showForm']");
      var begin_date = $("input[name='begin_date']").val();
      var end_date = $("input[name='end_date']").val();

      if(begin_date=="" || end_date==""){
        return alert("請輸入起始年月!");
      }

      if($('#ac_name').is(':visible')){
        $("input[name='chart_type']").val('1');
      }else if($('#ac_type').is(':visible')){
        $("input[name='chart_type']").val('2');
      }else if($('#ty_type').is(':visible')){
        $("input[name='chart_type']").val('3');
      }
      

      $(from).submit();
    }

    function show_chart(chart){
      if(chart=='1'){
        acivity_name();
      }else if(chart=='2'){
        acivity_type();
      }else if(chart=='3'){
        time_type();
      }
    }

    function acivity_name(){
      $("#ac_name").show();
      $("#ac_type").hide();
      $("#ty_type").hide();
      var text = $("#activity_text").val();
      var lines = text.split(/[,. ]+/g),
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

    function acivity_type(){
      $("#ac_name").hide();
      $("#ac_type").show();
      $("#ty_type").hide();
      Highcharts.chart('ac_type', {
        title: {
          text: '活動類型統計表'
        },

        xAxis: {
          categories: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
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

        series: [
          <?php 
            $namecount = count($name_array);
            for($i=0;$i<$namecount;$i++){
          ?>
            { name: '<?=$name_array[$i]?>',
              data: [
              <?php 
                $monthcount = count($month_array[$name_array[$i]]);
                for($j=0;$j<$monthcount;$j++){
              ?>
                <?=$month_array[$name_array[$i]][$j]?>,
              <?php
                }
              ?>
              ]
            },
          <?php
            }
          ?>
        ],

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

    function time_type(){
      $("#ac_name").hide();
      $("#ac_type").hide();
      $("#ty_type").show();
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
    data: [
      <?php 
          $timecount = count($time_array['time_name']);
          for($i=0;$i<$timecount;$i++){
        ?>
          ['<?=$time_array['time_name'][$i]?>', <?=$time_array['time_count'][$i]?>],
      <?php
            
          }
        ?>
    ]
  }]
});
    }

    function data_array(time_array){
      var data="";
      for(var i=0;i<time_array['time_name'].length;i++){
        data = data + ["'"+time_array['time_name'][i]+"','"+time_array['time_count'][i]+"'"]+",";
      }
      return data.substring(0,data.length-1);
    }

    function show(page){
        if($("input[name='admin']").val()=="Y" && page=="setting"){
            page = page + "_admin";
        }
        document.showForm.action=page+".php"; 
        document.showForm.submit();
    }
  </script>
</html>

