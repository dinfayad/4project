<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    
    <style>

        body,
        html {
            height: 100%;
            background-image: url(https://imgx.motorplus-online.com/crop/0x0:0x0/700x465/photo/2021/11/24/motor-rentaljpg-20211124110227.jpg);
            background-size: cover;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color:black;
            text-align: center;
            border-radius: 10px;
            padding: 20px;
            color: white;
        }

        button {
            width: 100px;
            padding: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.1s;
            font-size: 15px;
        }

        .container img {
            width: 100px;
        }


        .output {
            background-color: whitesmoke;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .output p {
            margin-bottom: 10px;
        }

            .output * {
                border: 1px solid black;
            }                                                                   

            .output button {
                display: none;
            }

            .output {
                width: 95%;
                margin: 0;
                background-color: white;
                color: black;
                padding: 30px;
                font-size: 20px;
            }

            .output h1 {
                color: red;
                font-size: 18px;
            }

            .output p {
                margin-bottom: 10px;
            }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <!-- Foto untuk cetak -->
            <img class="foto-cetak" src="honda.png" alt="">
            <h1><span style="color:red;">Rental Motor</span></h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="namaPelanggan" class="form-label">Nama Pelanggan:</label>
                    <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan">
                </div>
                <div class="mb-3">
                    <label for="lamaRental" class="form-label">Lama Waktu Rental (per hari):</label>
                    <input type="number" class="form-control" id="lamaRental" name="lamaRental">
                </div>
                <div class="mb-3">
                    <label for="jenisMotor" class="form-label">Jenis Motor:</label>
                    <select class="form-select" id="jenisMotor" name="jenisMotor">
                        <option value="vario">Vario</option>
                        <option value="scoopy">Scoopy</option>
                        <option value="beat">Beat</option>
                        <option value="pcx">PCX</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="background-color: red;">Submit</button>
            </form>
            <div class="output">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Tangani data formulir
                    $namaPelanggan = $_POST['namaPelanggan'];
                    $lamaRental = $_POST['lamaRental'];
                    $jenisMotor = $_POST['jenisMotor'];

                    // Harga per hari untuk semua jenis motor
                    $hargaRentalPerHari = array(
                        "vario" => 70000,
                        "scoopy" => 75000,
                        "beat" => 50000,
                        "pcx" => 90000
                    );

                    // Periksa jika jenis motor yang dipilih ada dalam daftar harga
                    if (array_key_exists($jenisMotor, $hargaRentalPerHari)) {
                        // Buat objek dari kelas buy dengan harga rental sesuai jenis motor yang dipilih
                        $rental = new buy($namaPelanggan, $hargaRentalPerHari[$jenisMotor], $lamaRental);

                        // Pemanggilan untuk menampilkan struk
                        $rental->struk();
                    } else {
                        echo "<p>Jenis motor yang dipilih tidak valid.</p>";
                    }
                }

                // Definisikan kelas di luar blok if ($_SERVER["REQUEST_METHOD"] == "POST")
                class Rental
                {
                    protected $NamaPelanggan;
                    protected $Price;
                    protected $Total;
                    protected $Pajak;
                    protected $Diskon;
                    protected $members;

                    public function __construct($NamaPelanggan, $Price, $Total)
                    {
                        $this->NamaPelanggan = $NamaPelanggan;
                        $this->Price = $Price;
                        $this->Total = $Total;
                        $this->Pajak = 10000; // Pajak Rp 10.000
                        $this->Diskon = 5 / 100;
                        $this->members = array("ana", "udin", "jamal", "fajar"); // Nama member
                    }

                    public function getNamaPelanggan()
                    {
                        return $this->NamaPelanggan;
                    }

                    public function getPrice()
                    {
                        return $this->Price;
                    }

                    public function getTotal()
                    {
                        return $this->Total;
                    }

                    public function getPajak()
                    {
                        return $this->Pajak;
                    }

                    public function getDiskon()
                    {
                        return $this->Diskon;
                    }

                    public function getMembers()
                    {
                        return $this->members;
                    }
                }

                class buy extends Rental
                {
                    public function __construct($NamaPelanggan, $Price, $Total)
                    {
                        parent::__construct($NamaPelanggan, $Price, $Total);
                    }

                    public function HitungJumlah()
                    {
                        $total = ($this->Price * $this->Total) + $this->Pajak;

                        // Potongan harga untuk member
                        if (in_array(strtolower($this->NamaPelanggan), $this->getMembers())) {
                            $total -= ($total * $this->Diskon);
                        }
                        return $total;
                    }

                    public function struk()
                    {
                        echo "<h1>Bukti Transaksi</h1>";
                        $total = $this->HitungJumlah();
                        echo "<p>" . $this->NamaPelanggan . " berhasil merental ";
                        echo "<br>";
                        echo "Jenis motor yang di rental adalah " . $_POST["jenisMotor"] . " selama " . $_POST["lamaRental"] . " hari";

                        // Menampilkan harga rental per hari untuk jenis motor yang dipilih
                        echo "<p>Harga Rental Per Hari: Rp. " . number_format($this->Price, 2, ',', '.') . "</p>";

                        // Menampilkan total harga dengan pajak
                        echo "<p>Total Harga (termasuk pajak): Rp. " . number_format($total, 2, ',', '.') . "</p>";

                        // Tambahkan tombol Print
                        echo '<button onclick="window.print()" class="btn btn-primary">Print</button>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>