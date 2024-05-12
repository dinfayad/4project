<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border: 2px solid black;
            background-color: aquamarine;
        }
        
        body {
            background-color: antiquewhite;
        }
        
    </style>
</head>
<body>
    <h1 align="center" style="font-size:30px;">Masukan data</h1>
    <form method="POST" action="">
        <table align="center">
        <tr>
            <td><label for="nama">Nama</label></td>
            <td><input type="text" placeholder="Nama" name="nama" id="nama"/></td>
        </tr>
        <tr>
            <td><label for="nis">Nis :</label></td>
            <td><input type="text" placeholder="Nis " name="nis" id="nis"/></td>
        </tr>
        <tr>
            <td><label for="rayon">Rayon:</label></td>
            <td><input type="text" placeholder="Rayon" name="rayon" id="rayon"/></td>
        </tr>
        <tr align="center">
            <td><button type="submit" name="kirim" >Iya  </button></td>
            <td><button type="submit" name="reset" >Tidak </button></td>
        </tr>
        </table>
    </form>
    <!-- pembuka php -->
    <?php
    //memulai sesi
    session_start();
    if(isset($_POST['reset'])){
        session_unset();
    }

    if(!isset($_SESSION["datasiswa"])){
        $_SESSION['datasiswa'] = array();
    }

    if(isset($_GET['hapus'])){
        $index = $_GET['hapus'];
        unset($_SESSION['datasiswa'][$index]);
    }

    if(isset($_POST['kirim'])){
    if(@$_POST['nama'] && @$_POST['nis'] && @$_POST['rayon']){
            if (isset($_SESSION['datasiswa'])){
            $data = [
                'nama' => $_POST['nama'],
                'nis' => $_POST['nis'],
                'rayon' => $_POST['rayon'],
            ];
            array_push($_SESSION['datasiswa'], $data);
            }
        }
    }

    if(!empty ($_SESSION['datasiswa'])){
        echo '<table style="margin-top:10px;" align="center">';
        echo '<tr>';
        echo '<td>Nama </td>';
        echo '<td>Nis</td>';
        echo '<td>Rayon</td>';
        echo '</tr>';   

    foreach($_SESSION['datasiswa'] as $index => $value){
        echo '<tr>';
        echo '<td>'. $value ['nama'] . '</td>';
        echo '<td>'. $value ['nis'] . '</td>';
        echo '<td>'. $value ['rayon'] . '</td>';
        echo '<td><a href=?hapus=' . $index .">Hapus</a></td>";
        echo '</tr>';
    }
}
    ?>
</body>
</html>