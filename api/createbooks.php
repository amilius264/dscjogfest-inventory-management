<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/books.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new books($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->foto = $data->foto;
    $item->judul_buku = $data->judul_buku;
    $item->age = $data->age;
    $item->penulis = $data->penulis;
    $item->tahun = $data->tahun;
    $item->genre = $data->genre;
    $item->isbn = $data->isbn;
    $item->rak_no = $data->rak_no;
    $item->stock = $data->stock;
    $item->penulisdeskripsi = $data->deskripsi;
    
    if($item->createbooks()){
        echo 'books created successfully.';
    } else{
        echo 'books could not be created.';
    }
?>