<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["nim"]))
         {
            $nim=$_GET["nim"];
            get_nilai_mahasiswa($nim);
         }
         else
         {
            get_nilai_mahasiswa_all();
         }
         break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if(!empty($data["nim"]) && !empty($data["kode_mk"]) && !empty($data["nilai"]))
        {
            $nim=$data["nim"];
            $kode_mk=$data["kode_mk"];
            $nilai=$data["nilai"];
            insert_nilai_mahasiswa($nim, $kode_mk, $nilai);
        }
        else
            {
            header("HTTP/1.0 400 Bad Request");
            $response=array(
               'status' => 0,
               'message' =>'Invalid Request. Missing required parameters.'
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        }     
            break;  
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if(!empty($data["nim"]) && !empty($data["kode_mk"]) && !empty($data["nilai"]))
        {
            $nim = $data["nim"];
            $kode_mk = $data["kode_mk"];
            $nilai = $data["nilai"];
            update_nilai_mahasiswa($nim, $kode_mk, $nilai);
        }
        else
        {
            header("HTTP/1.0 400 Bad Request");
            $response = array(
                'status' => 0,
                'message' => 'Invalid Request. Missing required parameters.'
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        break;        
    case 'DELETE':
        $nim = $_GET["nim"];
        $kode_mk = $_GET["kode_mk"];
        // var_dump($nim);
            delete_nilai_mahasiswa($nim, $kode_mk);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
 }


 function get_nilai_mahasiswa_all()
 {
    global $mysqli;
    $query="SELECT m.nim, m.nama, m.alamat, m.tanggal_lahir, p.kode_mk, mk.nama_mk, mk.sks, p.nilai 
            FROM mahasiswa m 
            INNER JOIN perkuliahan p ON m.nim = p.nim
            INNER JOIN matakuliah mk ON p.kode_mk = mk.kode_mk";
    $data=array();
    $result=$mysqli->query($query);
    while($row=mysqli_fetch_object($result))
    {
       $data[]=$row;
    }
    $response=array(
        'status' => 1,
        'message' =>'Get List Nilai Mahasiswa Successfully.',
        'data' => $data
     );
header('Content-Type: application/json');
echo json_encode($response);
}
 
function get_nilai_mahasiswa($nim=0)
{
    global $mysqli;
    $query="SELECT m.nim, m.nama, m.alamat, m.tanggal_lahir, p.kode_mk, mk.nama_mk, mk.sks, p.nilai 
            FROM mahasiswa m 
            INNER JOIN perkuliahan p ON m.nim = p.nim
            INNER JOIN matakuliah mk ON p.kode_mk = mk.kode_mk
            WHERE m.nim='$nim'";
    $data=array();
    $result=$mysqli->query($query);
    while($row=mysqli_fetch_object($result))
    {
       $data[]=$row;
    }
    $response=array(
                   'status' => 1,
                   'message' =>'Get Nilai Mahasiswa Successfully.',
                   'data' => $data
                );
    header('Content-Type: application/json');
    echo json_encode($response);
}
 
   function insert_nilai_mahasiswa()
   {
       global $mysqli;
       $data = json_decode(file_get_contents('php://input'), true);
   
       $result = mysqli_query($mysqli, "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$data[nim]', '$data[kode_mk]', '$data[nilai]')");
   
       if($result)
       {
           $response=array(
               'status' => 1,
               'message' =>'Nilai Mahasiswa Added Successfully.'
           );
       }
       else
       {
           $response=array(
               'status' => 0,
               'message' =>'Nilai Mahasiswa Addition Failed.'
           );
       }
       header('Content-Type: application/json');
       echo json_encode($response);
   }   
 
function update_nilai_mahasiswa($nim, $kode_mk)
   {
       global $mysqli;
       $data = json_decode(file_get_contents('php://input'), true);
   
       $result = mysqli_query($mysqli, "UPDATE perkuliahan SET nilai='$data[nilai]' WHERE nim='$nim' AND kode_mk='$kode_mk'");
   
       if($result)
       {
           $response=array(
               'status' => 1,
               'message' =>'Nilai Mahasiswa Updated Successfully.'
           );
       }
       else
       {
           $response=array(
               'status' => 0,
               'message' =>'Nilai Mahasiswa Updation Failed.'
           );
       }
       header('Content-Type: application/json');
       echo json_encode($response);
   }

function delete_nilai_mahasiswa($nim, $kode_mk)
   {
    // var_dump($nim);
       global $mysqli;
    //    $result = mysqli_query($mysqli, "DELETE FROM perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'");
        $query = "DELETE FROM perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'";


   
       if(mysqli_query($mysqli, $query))
      {
           $response=array(
               'status' => 1,
               'message' =>'Nilai Mahasiswa Deleted Successfully.'
           );
       }
       else
       {
           $response=array(
               'status' => 0,
               'message' =>'Nilai Mahasiswa Deletion Failed.'
           );
       }
       header('Content-Type: application/json');
       echo json_encode($response);
   }
?>
