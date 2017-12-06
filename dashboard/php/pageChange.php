<? 
$data = json_decode(file_get_contents("php://input"));
session_start();
if (count($data) > 0){
    $_SESSION["page"] = $data->page; 
    echo "success";
}
?>