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
    var Latlng=null;isGetGeocoder = false;
    if(address!='' && address!=undefined){
        $("input[name='address']").val(address);
    }else if(address==undefined){
        isGetGeocoder = true;
        address = $("input[name='address']").val();
    }
    
    if(number == undefined){
        number = $("input[name='no_address']").val();
    }else{
        $("input[name='no_address']").val(number);
    }

    var src = 'https://www.google.com/maps/embed/v1/place?key=AIzaSyBXjRJwCEvqKgxCnUsI-kGALYnJx0InesE&q='+address+"'";
    if(address==''){
        src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1872006.6619859105!2d119.89614287127868!3d23.59489858710433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346ed5cb2b61c3a5%3A0xcf20ddb042be7fa0!2z6Ie654Gj!5e0!3m2!1szh-TW!2stw!4v1553445703414';
    }
    
    if(isGetGeocoder){
        // Latlng = new google.maps.LatLng('10.85', '106.62');
        var geocoder = new google.maps.Geocoder(); 
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                Latlng = new google.maps.LatLng(latitude,longitude);
                $("input[name='copy_address']").val(results[0].formatted_address);
                setMarker(Latlng);
                console.log(results[0].formatted_address);
            } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
                setTaiwanMap(src);
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }else{
        setTaiwanMap(src);
    }
}

function setTaiwanMap(src){
    $("#map").html('<iframe width="465" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='+src+' allowfullscreen></iframe>');
}

function setMarker(Latlng){
    var mapOptions = {
        zoom:17,
        zoomControl:true,
        center:Latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById('map'),mapOptions);
    var marker = new google.maps.Marker({
        position: Latlng,
        map:map
    });
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
    var address = $("input[name='copy_address']").val();
    if(address==''){
        SweetAlertMessage("請先查詢地點或地址");
    }else{
        $("input[name='address']").val(address);
    }
}

// function initAddress() {
//     var geocoder = new google.maps.Geocoder();
//         geocoder.geocode( { 'address': address}, function(results, status) {
//             if (status == google.maps.GeocoderStatus.OK) {
//                 $("input[name='copy_address']").val(results[0].formatted_address);
//                 console.log(results[0].formatted_address);
//             } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
//                 // setTimeout(copyAddress(), 10000);
//             } else {
//                 alert("Geocode was not successful for the following reason: " + status);
//             }
//         });
//   }