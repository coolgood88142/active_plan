<html>
  <head>
    <title>規劃行程系統</title>
  </head>
  <!-- jQuery v1.9.1 -->
<script src="jquery-1.12.4.js"></script>
<!-- DataTables v1.10.16 -->
<link href="jquery.dataTables.min.css" rel="stylesheet" />
<script src="jquery.dataTables.min.js"></script>
<script src="highcharts.js"></script>
<script src="highcharts-3d.js"></script>
<script src="series-label.js"></script>
<script src="exporting.js"></script>
<script src="export-data.js"></script>
<script src="wordcloud.js"></script>
<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery-ui.js"></script>
<?php session_start();
    include("mysql.php");


    $us_admin = $_SESSION['us_admin'];
    if(!empty($us_admin)){
        date_default_timezone_set('Asia/Taipei');
        $today_year = date ("Y");
        include("select_activity.php"); 
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
    });

    function openDate(name){
      $(name).datepicker({
          dateFormat: "yy-mm",
          changeMonth : true,
          changeYear : true,
          showMonthAfterYear : true,
          monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
          onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('yy-mm', new Date(year, month, 1)));
          }
      });

      $(name).focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
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
      }else if($('#ac_type').is(':visible')){
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
          $count = count($time_array['time_name']);
          for($i=0;$i<$count;$i++){
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

