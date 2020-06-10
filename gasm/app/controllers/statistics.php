<?php
session_start();
class Statistics extends Controller
{
    private $post;
    private $database;
    private $db;
    public function __construct()
    {
        $this->database = new Database();
        $this->db= $this->database -> connect();
        $this->post = $this->model('Post',$this->db);
    
    }
    
    public function index()
    {
     if(!isset( $_SESSION['username']))
     {
         $this->view('login');
     }else{
         $this->view('statistics');
     }
    }
    public function redirectPage()
    {if(!isset( $_SESSION['username']))
     {
         $this->view('login');
     }else{
     
     $this->view('show_statistics');
     }
    }
   public function exportCSV(){
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        
    
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($_POST['time']) && isset($_POST['space'])){
        $data = [
            'time' =>trim($_POST['time']),
            'space' => trim($_POST['space']),
        ];
            $filename = "report_csv.csv";
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            $fp = fopen('php://output', 'w');
            $result = $this->post->read($data['time'],$data['space']);
            $num = $result->rowCount();
            if($num > 0){
            //Post array
            if(strcasecmp($data['space'],'neighborhood')==0){
                $header = [
                    'id' => 'Report id',
                    'city' => 'City',
                    'cartier' => 'District',
                    'material' => 'Material',
                    'quantity' => 'Quantity'
                ];
                fputcsv($fp,$header);
                $id = 1;
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    if($glass_quantity!=0){
                    $post_item = array(
                        'Report_id' => $id,
                        'City' => utf8_encode($city),
                        'District' => $cartier,
                        'Material' =>'glass',
                        'Quantity' => $glass_quantity
                    );
                    $id ++;
                    fputcsv($fp, $post_item);
                }
                if($paper_quantity!=0){
                    $post_item = array(
                        'Report_id' => $id,
                        'City' => utf8_encode($city),
                        'District' => $cartier,
                        'Material' =>'paper',
                        'Quantity' => $paper_quantity
                    );
                    $id ++;
                    fputcsv($fp, $post_item);
                }
                if($plastic_quantity!=0){
                    $post_item = array(
                        'Report_id' => $id,
                        'City' => utf8_encode($city),
                        'District' => $cartier,
                        'Material' =>'plastic',
                        'Quantity' => $plastic_quantity
                    );
                    $id ++;
                    fputcsv($fp, $post_item);
                }
        
                }
            }else{
                $header = [
                    'id' => 'Report id',
                    'city' => 'City',
                    'Material' =>'Material',
                    'quantity' => 'Quantity'
                ];
                fputcsv($fp,$header);
                $id = 1;
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    if($glass_quantity!=0){
                    $post_item = array(
                        'Report_id' => $id,
                        'City' => $city,
                        'Material' => 'glass',
                        'Quantity' => $glass_quantity
                    );
                    $id ++;
                    fputcsv($fp, $post_item);
                }
                if($paper_quantity!=0){
                    $post_item = array(
                        'Report_id' => $id,
                        'City' => $city,
                        'Material' => 'paper',
                        'Quantity' => $paper_quantity
                    );
                    $id ++;
                    fputcsv($fp, $post_item);
                }
                if($glass_quantity!=0){
                    $post_item = array(
                        'Report_id' => $id,
                        'City' => $city,
                        'Material' => 'plastic',
                        'Quantity' => $plastic_quantity
                    );
                    $id ++;
                    fputcsv($fp, $post_item);
                }

                }
            }
            } else {
            //no posts
            json_encode(
                array('message'=>'No Posts Found')
            );
            }
            }
        }else{
        echo 'There is a problem!';
    }
    } 

}