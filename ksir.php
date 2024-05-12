<?php

class Produk {
    private $nama;
    private $harga;

    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getHarga() {
        return $this->harga;
    }
}

class ItemKeranjang {
    private $produk;
    private $kuantitas;

    public function __construct($produk, $kuantitas) {
        $this->produk = $produk;
        $this->kuantitas = $kuantitas;
    }

    public function getProduk() {
        return $this->produk;
    }

    public function getKuantitas() {
        return $this->kuantitas;
    }

    public function getTotalHarga() {
        return $this->produk->getHarga() * $this->kuantitas;
    }
}

class Keranjang {
    private $item = [];

    public function tambahItem($produk, $kuantitas) {
        $this->item[] = new ItemKeranjang($produk, $kuantitas);
    }

    public function getItem() {
        return $this->item;
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->item as $item) {
            $total += $item->getTotalHarga();
        }
        return $total;
    }
}

class Kasir {
    private $keranjang;

    public function __construct($keranjang) {
        $this->keranjang = $keranjang;
    }

    public function bayar() {
        $total = $this->keranjang->getTotal();
        echo "<p>Total yang harus dibayar adalah: Rp" . number_format($total, 2) . "</p>";
        $this->cetakStruk();
    }

    public function cetakStruk() {
        $item = $this->keranjang->getItem();
        echo "<h2>STRUK PEMBELIAN</h2>";
        echo "<pre>-------------------------</pre>";
        foreach ($item as $itemDetail) {
            echo "<p>" . $itemDetail->getProduk()->getNama() . " - ";
            echo $itemDetail->getKuantitas() . " x ";
            echo "Rp" . number_format($itemDetail->getProduk()->getHarga(), 2) . " = ";
            echo "Rp" . number_format($itemDetail->getTotalHarga(), 2) . "</p>";
        }
        echo "<pre>-------------------------</pre>";
        echo "<p>Total Pembayaran: Rp" . number_format($this->keranjang->getTotal(), 2) . "</p>";
        echo "<p>Terima Kasih!</p>";
    }
}

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaProduk = $_POST['namaProduk'];
    $hargaProduk = floatval($_POST['hargaProduk']);
    $kuantitas = intval($_POST['kuantitas']);

    $produk = new Produk($namaProduk, $hargaProduk);
    $keranjang = new Keranjang();
    $keranjang->tambahItem($produk, $kuantitas);

    $kasir = new Kasir($keranjang);
    $kasir->bayar();
}
?>

<style>
    .table {
        background-color: aquamarine;
        width : 200px;
        padding:0px 25px 0px 25px;
        height: 230px;
        border-radius: 10px;
        margin-left: 620px;
    }

    body {
        background-color: antiquewhite;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Toko</title>
</head>
<body>
    <h1><span style="color:red; margin-left:650px;">Kasir Toko</span></h1>
    <div class="table">
    <form action="" method="post">
        <label for="namaProduk">Nama Produk:</label><br>
        <input type="text" id="namaProduk" name="namaProduk" required><br><br>
        <label for="hargaProduk">Harga Produk (Rp):</label><br>
        <input type="text" id="hargaProduk" name="hargaProduk" required><br><br>
        <label for="kuantitas">Kuantitas:</label><br>
        <input type="number" id="kuantitas" name="kuantitas" required><br><br>
        <input type="submit" value="Bayar">
    </form>
    </div>
</body>
</html>