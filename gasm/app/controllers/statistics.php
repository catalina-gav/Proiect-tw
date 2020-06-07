<?php
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
    
        $this->view('statistics');
   }
   public function redirectPage()
   {
    $this->view('show_statistics');
   }
   public function exportCSV(){
    if ($_SERVER['REQUEST_METHOD']=='GET'){
        $filename = "report_csv.csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        
        $fp = fopen('php://output', 'w');
       $result = $this->post->read();
       $num = $result->rowCount();
       if($num > 0){
           //Post array
           header('Content-type: application/csv');
           header('Content-Disposition: attachment; filename='.$filename);
           $filename = "report_csv.csv";
           $fp = fopen('php://output', 'w');
           $posts_arr = array();
           $posts_arr['data'] = array();
           while($row = $result->fetch(PDO::FETCH_ASSOC)){
               extract($row);
               $post_item = array(
                   'Report_id' => $id,
                   'City' => $city,
                   'Neighbourhood' => $cartier,
                   'Quantity' => $trash,
                   'Reported_At' => $notice_date
               );
               fputcsv($fp, $post_item);
               array_push($posts_arr['data'],$post_item);
           }
          
       } else {
           //no posts
           json_encode(
               array('message'=>'No Posts Found')
           );
       }
    }
   }
}