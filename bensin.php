<?php
class Shell {
    public $total,
    $jumlah,
    $jenis,
    $harga,
    $ppn = 0.1;

    function __construct($jumlah, $jenis)
    {
        switch ($jenis){
            case "supershell":
                $this->harga = 15420;
                break;
            case "shellvpower":
                $this->harga = 16130;
                break;
            case "shellvpowerdiesel":
                $this->harga = 18310;
                break;
            case "shellvpowernitro":
                $this->harga = 16510;
                break;
        }

        $this->total = $this->harga * $jumlah - ($this->harga * $jumlah * $this->ppn);
    }
}

class Beli extends Shell {
        public function __construct($jumlah, $jenis)
        {
        parent::__construct($jumlah, $jenis);
    }
}



?>
<style>
    .contain {
        background-color: white;
        width: 550px;
        margin-left: 500px;
    }
    

</style>

<body style="text-align: center; background-image: url(https://c8.alamy.com/comp/AA79YM/shell-gas-station-sign-showing-possible-future-price-of-five-us-dollars-AA79YM.jpg); font-family: 'Poppins';">
    <form action="" method="POST">
        <div class="contain">
        <h1>Masukan Jumlah Liter</h1>
        <input type="text" placeholder="Masukan Jumlah Liter" name="inputLiter" id="inputLiter" required>
        <h2>Pilih Tipe Bahan Bakar</h2>
        <div class="btn">
            <select name="bensin" id="bensin">
                <option value="supershell">Super Shell</option>
                <option value="shellvpower">Shell V Power</option>
                <option value="shellvpowerdiesel">Shell V Power Diesel</option>
                <option value="shellvpowernitro">Shell V Power Nitro</option>
            </select>
            <button  type="submit" name="beli">Beli</button>
            <?php
if(isset($_POST['beli'])) {
    $jumlah = $_POST['inputLiter'];
    $jenis = $_POST['bensin'];
    $shell = new Beli($jumlah, $jenis);
    echo "<br>";
    echo "---------------------------------------------------------- <br>";
    echo "Total Yang Harus Anda Bayar Adalah " . "Rp." . $shell->total . "<br>Dengan Jumlah $jumlah Liter<br>Dengan Tipe Bensin $jenis <br>";
    echo "----------------------------------------------------------";
}
?>
        </div>
        </div>
    </form>
</body>


