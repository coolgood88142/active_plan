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


    $("#map").on('load',function () {                        
        var doc = frames["map"].document.body.innerHTML;
        console.log(doc);
    });
});

function SweetAlertMessage(message){
    swal({
        title: message,
        confirmButtonColor: "#e6b930",
        showCloseButton: true
    });
}

// function initMap(){
//     var mapOptions = {
//         zoom:17,
//         mapTypeId:google.maps.MapTypeId.ROADMAP
//     }
//     var map = new google.maps.Map(document.getElementById('map'), mapOptions);

//     var address = '台北101';
//     var geocoder = new google.maps.Geocoder();
//         geocoder.geocode( { 'address': address}, function(results, status) {
//             if (status == 'OK') {
//             map.setCenter(results[0].geometry.location);
//             var marker = new google.maps.Marker({
//                 map: map,
//                 position: results[0].geometry.location
//             });
//             } else {
//             console.log(status);
//             }
//         });
// }


function openAddressMap(address,number){
    //新增項目時地圖預設顯是台灣
    if(address==''){
        address = "taiwan";
    }else{
        $("input[name='address']").val(address);
    }
    $(".modal-body").html('<iframe id="map" name="map" width="465" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAo5H0Uv3lvuQKHA-VLh0lw8SPjxfGwLEc&q='+address+'" allowfullscreen></iframe>');
    $("input[name='no_address']").val(number);

    // var geocoder = new google.maps.Geocoder();
    //     geocoder.geocode( { 'address': address}, function(results, status) {
    //         if (status == google.maps.GeocoderStatus.OK) {
    //             $("input[name='address']").val(results[0].formatted_address);
    //             var marker = new google.maps.Marker({
    //                 map: map,
    //                 position: results[0].geometry.location
    //             });
    //         } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
    //             SweetAlertMessage("每複製1次需要100秒之後在複製");
    //         } else {
    //             alert("Geocode was not successful for the following reason: " + status);
    //         }
    //     });
}

function queryAddress(){
    openAddressMap($("input[name='address']").val(),$("input[name='no_address']").val());
}

function saveAddress(){
    var no = $("input[name='no_address']").val();
    var address = $("input[name='address']").val();
    var in_address = $("input[name='in_address"+no+"']").val();
    var pn_address =  $(".pn_address"+no);
    pn_address.html('<span data-toggle="modal" data-target="#myModal">'
    +'<img src="./assets/images/magnifier.png" alt="" id="magnifier" name="magnifier" class="img-thumbnail" data-toggle="tooltip" title="'+address+'" onClick="openAddressMap(\''+address+'\',\''+no+'\')"/>'
    +'</span>');

    if(in_address==''){
        $("input[name='in_address"+no+"']").val(address);
    }else{
        $(".address"+no).find("input[name='pn_address']").val(address);
        $(".address"+no).find("input[name='up_address']").val(address);
        $(".address"+no).find("input[name='up_no']").val(no);
    }
}

function copyAddress(){
    //先取得地址欄位資料
    var address = $("input[name='address']").val();
    if(address==''){
        SweetAlertMessage("請先查詢地點或地址");
    }

    // var map = $("#map").goMap();
    // console.log($(map));


    //經緯度
    // var lat,lng;
    // navigator.geolocation.watchPosition((position) => {
    //     lat = position.coords.latitude;
    //     lng = position.coords.longitude;
    // });
    
    var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $("input[name='address']").val(results[0].formatted_address);
                console.log(results[0].formatted_address);
            } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
                SweetAlertMessage("每複製1次需要100秒之後在複製");
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
}