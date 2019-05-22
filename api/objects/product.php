<?php
class Product{

    private $conn;
    private $table_name = "barang";

    public $kode_barang;
    public $nama_barang;
    public $jenis_barang;
    public $harga;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT * FROM barang";

                    $stmt = $this->conn->prepare($query);

                    $stmt->execute();

                    return $stmt;
    }

    function create(){

        $query = "INSERT INTO
                    " . $this->table_name ."
                SET
                    kode_barang=:kode_barang, nama_barang=:nama_barang,
                    jenis_barang=:jenis_barang,
                    harga=:harga";

        $stmt = $this->conn->prepare($query);

        $this->kode_barang=htmlspecialchars(strip_tags($this->kode_barang));
        $this->nama_barang=htmlspecialchars(strip_tags($this->nama_barang));
        $this->jenis_barang=htmlspecialchars(strip_tags($this->jenis_barang));
        $this->harga=htmlspecialchars(strip_tags($this->harga));

        $stmt->bindparam(":kode_barang", $this->kode_barang);
        $stmt->bindparam(":nama_barang", $this->nama_barang);
        $stmt->bindparam(":jenis_barang", $this->jenis_barang);
        $stmt->bindparam(":harga", $this->harga);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function update(){

        $query = "UPDATE
                    " . $this->table_name ."
                SET
                    kode_barang=:kode_barang,
                    nama_barang=:nama_barang,
                    jenis_barang=:jenis_barang,
                    harga=:harga
                WHERE
                    kode_barang = :kode_barang";

        //prepare query statement    
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->kode_barang=htmlspecialchars(strip_tags($this->kode_barang));
        $this->nama_barang=htmlspecialchars(strip_tags($this->nama_barang));
        $this->jenis_barang=htmlspecialchars(strip_tags($this->jenis_barang));
        $this->harga=htmlspecialchars(strip_tags($this->harga));

        $stmt->bindparam(":kode_barang", $this->kode_barang);
        $stmt->bindparam(":nama_barang", $this->nama_barang);
        $stmt->bindparam(":jenis_barang", $this->jenis_barang);
        $stmt->bindparam(":harga", $this->harga);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
?>