<?php
if(isset($_POST['submit'])) {    
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    //Pastikan sesuai dengan alamat endpoint dari REST API
    $url = 'http://localhost/UTS_PSAIT_2024/sait_db_api/sait_db_api.php';
    $ch = curl_init($url);

    // Data yang akan di-update
    $jsonData = array(
        'nim' => $nim,
        'kode_mk' => $kode_mk,
        'nilai' =>  $nilai,    
    );

    // Mengencode array menjadi JSON.
    $jsonDataEncoded = json_encode($jsonData);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Tell cURL that we want to send a PUT request.
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

    //Attach our encoded JSON string to the PUT fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);

    //var_dump($result);
    print("<center><br>status :  {$result["status"]} "); 
    print("<br>");
    print("message :  {$result["message"]} "); 
    echo "<br>Sukses mengupdate nilai mahasiswa!";
    echo "<br><a href=selectNilaiView.php> OK </a>";
}

?>