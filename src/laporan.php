<?php
require_once './config.php';
// jika akun belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: " . URL . '/');
    exit();
}

// harus akun pengguna
$pengguna_data = $_db->query("SELECT id_pengguna from pengguna where id_akun = {$_SESSION['user_id']}");

if (!$pengguna_data or mysqli_num_rows($pengguna_data) < 1) {
    header("Location: " . URL . '/');
    exit();
}
$tanggal = "";
$where_clause = "";

$temp = explode('-', $_GET['date']);
$year = (int) $temp[0];
$month = (int) $temp[1];

// Main fetching
if (isset($_GET['date']) or isset($_GET['search']) or isset($_GET['group'])) {
    $query = array();
    if (isset($_GET['date'])) {
        $temp = explode('-', $_GET['date']);
        $year = (int) $temp[0];
        $month = (int) $temp[1];
        array_push($query, "MONTH(tanggal) = '{$month}' AND YEAR(tanggal) = '{$year}'");
    }
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        array_push($query, "nama LIKE '%{$search}%'");
    }
    if (isset($_GET['group'])) {
        $group = $_GET['group'];
        array_push($query, "id_grup = '{$group}'");
    }
    if (sizeof($query) > 0) {
        $where_clause = join(" AND ", $query);
        $where_clause = $where_clause . ' AND ';
    }
}
$groupName = "";

if (isset($_GET['group'])) {
    $group = $_GET['group'];
    $groupName = $_db->query("SELECT nama_grup FROM grup WHERE id_grup ='{$group}'")->fetch_array()['nama_grup'];
}

$pengguna_data = $pengguna_data->fetch_array();

$monthName = DateTime::createFromFormat('!m', $month);
$monthName = $monthName->format('F');

$profil_data = $_db->query("SELECT nama from profil where id_pengguna = {$pengguna_data['id_pengguna']}");
$profil_data = $profil_data->fetch_array();

$transaction_data = $_db->query("SELECT * FROM transaksi WHERE {$where_clause} id_pengguna = {$pengguna_data['id_pengguna']} ORDER BY tanggal DESC");
$in_data = $_db->query("SELECT SUM(jumlah) as total_in FROM transaksi WHERE {$where_clause} tipe_transaksi='income' AND id_pengguna = {$pengguna_data['id_pengguna']}")->fetch_array();
$out_data = $_db->query("SELECT SUM(jumlah) as total_out FROM transaksi WHERE {$where_clause} tipe_transaksi='expense' AND id_pengguna = {$pengguna_data['id_pengguna']}")->fetch_array();

if (!$transaction_data or !$in_data or !$out_data) {
    $response = [
        'error' => true,
        'message' => "Server error: {$_db->error}",
        'stacktrace' => "{$where_clause}"
    ];
    http_response_code(500);
    echo json_encode($response);
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keuangan</title>
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <script>
        function getMonthName(monthNumber) {
            const date = new Date();
            date.setMonth(monthNumber - 1);

            // Using the browser's default locale.
            return date.toLocaleString([], { month: 'long' });
        }
    </script>
    <p>
        <center>LAPORAN PEMASUKAN DAN PENGELUARAN</center>
    </p>
    <p>
        <center>
            Periode
            <?= $monthName ?> Tahun
            <?= $year ?>
        </center>
    </p>
    <pre>
    <tr>NAMA         : <?= $profil_data['nama'] ?> </tr><br>
    <tr>ID PENGGUNA  : <?= $pengguna_data['id_pengguna'] ?> </tr><br>
    <tr>GRUP         : <?= $groupName ?> </tr>
    </pre>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Judul Transaksi</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
        </tr>
        <tr>
            <td>1</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>4</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">Total Perbulan</td></b>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">Saldo Perbulan</td>
            <td></td>
            <td></td>
        </tr>
    </table>
</body>

</html>