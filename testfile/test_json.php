<?php if(isset($_POST['chart_type']) && isset($_POST['admin'])){
    $output = array(
        "price" => 450,
        "note" => "要等很久",
        "chart_type" => $_POST['chart_type'],
        "admin" => $_POST['admin']
);
echo json_encode($output);
}
?>