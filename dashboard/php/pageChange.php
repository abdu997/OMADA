<? 
$data = json_decode(file_get_contents("php://input"));
session_start();
if (count($data) > 0){
    $page = $data->page;
    $_SESSION['page'] = $page; 
    echo "success";
}
?>