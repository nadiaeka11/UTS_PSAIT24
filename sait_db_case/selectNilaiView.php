<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scores Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style>
        div.scroll {
        width: 600px;
        height: 400px;
        overflow: scroll;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Scores Students</h2>
                        <a href="insertNilaiView.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                    <div class="scroll">
                    <?php
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    //Pastikan sesuai dengan alamat endpoint dari REST API di SERVER, 
                    curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT_2024/sait_db_api/sait_db_api.php');
                    $res = curl_exec($curl);
                    $json = json_decode($res, true);
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>NIM</th>";
                                        echo "<th>Kode MK</th>";
                                        echo "<th>Nilai</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                // foreach ($json["data"] as $data){
                                //     echo "<tr>";
                                //         echo "<td> {$data["nim"]} </td>";
                                //         echo "<td> {$data["kode_mk"]} </td>";
                                //         echo "<td> {$data["nilai"]} </td>";
                                //         echo "<td>";
                                //             echo '<a href="updateNilaiView.php?nim=' . $data["nim"] . '&kode_mk=' . $data["kode_mk"] . '&nilai=' . $data["nilai"] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                //             echo '<a href="deleteNilaiDo.php?nim=' . $data["nim"] . '&kode_mk=' . $data["kode_mk"] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                //         echo "</td>";
                                //     echo "</tr>";
                                // }
                                for ($i = 0; $i < count($json["data"]); $i++) {
                                    echo "<tr>";
                                    echo "<td> {$json["data"][$i]["nim"]} </td>";
                                    echo "<td> {$json["data"][$i]["kode_mk"]} </td>";
                                    echo "<td> {$json["data"][$i]["nilai"]} </td>";
                                    echo "<td>";
                                    echo '<a href="updateNilaiView.php?nim=' . $json["data"][$i]["nim"] . '&kode_mk=' . $json["data"][$i]["kode_mk"] . '&nilai=' . $json["data"][$i]["nilai"] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="deleteNilaiDo.php?nim=' . $json["data"][$i]["nim"] . '&kode_mk=' . $json["data"][$i]["kode_mk"] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                
                                echo "</tbody>";                            
                            echo "</table>";

                    curl_close($curl);
                    ?>
                </div>
                </div>
            </div>        
        </div>
    </div>

    <p><p><p>
    
</body>
</html>