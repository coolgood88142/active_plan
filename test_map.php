<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="UTF-8">
  <meta name="author" content="oxxo.studio">
  <meta name="copyright" content="oxxo.studio">
  <title>地址</title>
  <?php include("link.php");?>
</head>
<?php session_start();
  
?>
<body>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Click For Map</button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>

<script language="JavaScript">
$('#myModal').on('shown.bs.modal', (function() {
  var mapIsAdded = false;

  return function() {
    if (!mapIsAdded) {
      $('.modal-body').html('<iframe width="465" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBXjRJwCEvqKgxCnUsI-kGALYnJx0InesE&q=taiwan" allowfullscreen></iframe>');

      mapIsAdded = true;
    }    
  };
})());
</script>
</html>