<?php
    class books{

        // Connection
        private $conn;

        // Table
        private $db_table = "books";

        // Columns
        public $id;
        public $foto;
        public $judul_buku;
        public $penulis;
        public $tahun;
        public $genre;
        public $isbn;
        public $rak_no;
        public $stock;
        public $deskripsi;


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getbooks(){
            $sqlQuery = "SELECT id, foto, judul_buku, penulis, tahun, genre, isbn, rak_no, stock, deskripsi FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createbooks(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        foto = :foto, 
                        judul_buku = :judul_buku, 
                        penulis = :penulis, 
                        tahun = :tahun, 
                        genre = :genre, 
                        isbn= :isbn, 
                        rak_no = :rak_no, 
                        stock = :stock, 
                        deskripsi = :deskripsi";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->foto=htmlspecialchars(strip_tags($this->foto));
            $this->judul_buku=htmlspecialchars(strip_tags($this->judul_buku));
            $this->penulis=htmlspecialchars(strip_tags($this->penulis));
            $this->tahun=htmlspecialchars(strip_tags($this->tahun));
            $this->genre=htmlspecialchars(strip_tags($this->genre));
            $this->isbn=htmlspecialchars(strip_tags($this-isbn));
            $this->rak_no=htmlspecialchars(strip_tags($this->rak_no));
            $this->stock=htmlspecialchars(strip_tags($this->stock));
            $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));





        
            // bind data
            $stmt->bindParam(":foto", $this->foto);
            $stmt->bindParam(":judul_buku", $this->judul_buku);
            $stmt->bindParam(":penulis", $this->penulis);
            $stmt->bindParam(":tahun", $this->tahun);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":isbn", $this->isbn);
            $stmt->bindParam(":rak_no", $this->rak_no);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":deskripsi", $this->deskripsi);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleBooks(){
            $sqlQuery = "SELECT
                        id, 
                        foto, 
                        judul_buku, 
                        penulis, 
                        tahun, 
                        genre, 
                        isbn, 
                        rak_no, 
                        stock, 
                        deskripsi
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->foto = $dataRow['foto'];
            $this-> judul_buku = $dataRow['judul_buku'];
            $this->penulis = $dataRow['penulis'];
            $this->tahun = $dataRow['tahun'];
            $this->genre = $dataRow['genre'];
            $this->isbn = $dataRow['isbn'];
            $this->rak_no = $dataRow['rak_no'];
            $this->stock = $dataRow['stock'];
            $this->deskripsi = $dataRow['deskripsi'];
        }        

        // UPDATE
        public function updateBooks(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        foto = :foto, 
                        judul_buku = :judul_buku, 
                        penulis = :penulis, 
                        tahun = :tahun, 
                        genre = :genre
                        isbn = :isbn
                        rak_no = :rak_no
                        stock = :stock
                        deskripsi = :deskripsi
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->foto=htmlspecialchars(strip_tags($this->foto));
            $this->judul_buku=htmlspecialchars(strip_tags($this->judul_buku));
            $this->penulis=htmlspecialchars(strip_tags($this->penulis));
            $this->tahun=htmlspecialchars(strip_tags($this->tahun));
            $this->genre=htmlspecialchars(strip_tags($this->genre));
            $this->isbn=htmlspecialchars(strip_tags($this->isbn));
            $this->rak_no=htmlspecialchars(strip_tags($this->rak_no));
            $this->stock=htmlspecialchars(strip_tags($this->stock));
            $this->deskripsi=htmlspecialchars(strip_tags($this->deskripsi));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":foto", $this->foto);
            $stmt->bindParam(":judul_buku", $this->judul_buku);
            $stmt->bindParam(":penulis", $this->penulis);
            $stmt->bindParam(":tahun", $this->tahun);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":isbn", $this->isbn);
            $stmt->bindParam(":rak_no", $this->rak_no);
            $stmt->bindParam(":stock", $this->stock);
            $stmt->bindParam(":deskripsi", $this->deskripsi);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteBooks(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
