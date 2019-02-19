function datatable_language(){
    var language = {
        "language": {
            "processing":   "處理中...",
            "loadingRecords": "載入中...",
            "lengthMenu":   "顯示 _MENU_ 項結果",
            "zeroRecords":  "沒有符合的結果",
            "info":         "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
            "infoEmpty":    "顯示第 0 至 0 項結果，共 0 項",
            "infoFiltered": "(從 _MAX_ 項結果中過濾)",
            "infoPostFix":  "",
            "search":       "搜尋:",
            "paginate": {
                "first":    "第一頁",
                "previous": "上一頁",
                "next":     "下一頁",
                "last":     "最後一頁"
            },
            "aria": {
                "sortAscending":  ": 升冪排列",
                "sortDescending": ": 降冪排列"
            }
        },
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": [
            {   
                text: '隱藏項目',
                extend: 'colvis',
                className: 'colvisButton',
                columns: ':gt(3)'
            }
        ]
    };
    return language;
}

$(window).on('beforeunload',function(){
    location.href = "freed.php";
});

$(function(){
    var sideslider = $('[data-toggle=collapse-side]');
        var get_sidebar = sideslider.attr('data-target-sidebar');
        var get_content = sideslider.attr('data-target-content');
        sideslider.click(function(event){
          $(get_sidebar).toggleClass('in');
          $(get_content).toggleClass('out');
    });
});

function SweetAlertMessage(message){
    swal({
        title: message,
        confirmButtonColor: "#e6b930",
        showCloseButton: true
    });
}

function openAddressMap(address,number){
    //新增項目時地圖預設顯是台灣
    if(address==''){
        address = "taiwan";
    }
    $(".modal-body").html('<iframe width="465" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBXjRJwCEvqKgxCnUsI-kGALYnJx0InesE&q='+address+'" allowfullscreen></iframe>');
    $("input[name='no_address']").val(number);    
}

function queryAddress(){
    openAddressMap($("input[name='address']").val(),$("input[name='no_address']").val());
}

function saveAddress(){
    var no = $("input[name='no_address']").val();
    var address = $("input[name='address']").val();
    var in_address = $("input[name='in_address"+no+"']").val();
    var pn_address =  $(".pn_address"+no);
    pn_address.html('<img src="./assets/images/magnifier.png" alt="" id="magnifier" name="magnifier" class="img-thumbnail" data-toggle="tooltip" title="'+address+'"/>');
    // $(".run"+no).html(
    //     '<div style="text-align:center">'
    //     + '<input type="button" class="btn btn-primary" name="cancel" value="取消" onClick="Cancel(this)"/>'
    //     + '&nbsp'
    //     + '<input type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" value="查詢地址" onClick="openAddressMap(\''+address+"','"+no+'\')"/>'
    //     + '</div>'
    // );

    if(in_address==''){
        $("input[name='in_address"+no+"']").val(address);
    }else{
        $(".address"+no).find("input[name='up_address']").val(address);
        $(".address"+no).find("input[name='up_no']").val(no);
    }
}