<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/books.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new books($db);

    $stmt = $items->getbooks();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $booksArr = array();
        $booksArr["body"] = array();
        $booksArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "foto" => $foto,
                "judul_buku" => $judul_buku,
                "penulis" => $penulis,
                "tahun" => $tahun,
                "genre" => $genre,
                "isbn" => isbn,
                "rak_no" => $rak_no,
                "stock" => $stock,
                "deskripsi" => $deskripsi
            );

            array_push($booksArr["body"], $e);
        }
        echo json_encode($booksArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>