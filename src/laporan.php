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

if ($result = $_db->query("SELECT judul, deskripsi, tanggal, id_grup FROM laporan where id_laporan = '{$_GET['id']}'")) {
    $result = $result->fetch_array();
    $judul = $result['judul'];
    $id_grup = $result['id_grup'];
    $tanggal = $result['tanggal'];
    $deskripsi = $result['deskripsi'];
} else {
    $response = [
        'error' => true,
        'message' => "Server error: {$_db->error}"
    ];
    http_response_code(500);
    echo json_encode($response);
    exit();
}

$where_clause = "";

$where_clause_for_past = "";
$past_where_month_clause = '';
$past_where_year_clause = '';
// Main fetching
if (isset($tanggal) or isset($id_grup)) {
    $query = array();
    $query2 = array();
    if (isset($tanggal)) {
        $temp = explode('-', $tanggal);
        $year = (int) $temp[0];
        $month = (int) $temp[1];
        $past_where_month_clause = $month;
        $past_where_year_clause = $year;
        array_push($query, "MONTH(tanggal) = '{$month}' AND YEAR(tanggal) = '{$year}'");
    }
    if (isset($id_grup)) {
        $group = $id_grup;
        array_push($query, "id_grup = '{$group}'");
        array_push($query2, "id_grup = '{$group}'");

    }
    if (sizeof($query) > 0) {
        $where_clause = join(" AND ", $query);
        $where_clause = $where_clause . ' AND ';
    }
    if (sizeof($query2) > 0) {
        $where_clause_for_past = join(" AND ", $query2);
        $where_clause_for_past = $where_clause_for_past . ' AND ';
    }
}
$groupName = "";

if (isset($id_grup)) {
    $group = $id_grup;
    $groupName = $_db->query("SELECT nama_grup FROM grup WHERE id_grup ='{$group}'")->fetch_array()['nama_grup'];
}

$pengguna_data = $pengguna_data->fetch_array();

$monthName = DateTime::createFromFormat('!m', $month);
$monthName = $monthName->format('F');

$profil_data = $_db->query("SELECT nama from profil where id_pengguna = {$pengguna_data['id_pengguna']}");
$profil_data = $profil_data->fetch_array();

$transaction_data = $_db->query("SELECT * FROM transaksi WHERE {$where_clause} id_pengguna = {$pengguna_data['id_pengguna']} ORDER BY tanggal ASC");

$past_in_data = $_db->query("SELECT SUM(jumlah) as transaksi_in FROM transaksi WHERE {$where_clause_for_past} MONTH(tanggal) < '{$past_where_month_clause}' AND YEAR(tanggal) <= '{$past_where_year_clause}' AND tipe_transaksi='income' AND id_pengguna = {$pengguna_data['id_pengguna']}");
$past_out_data = $_db->query("SELECT SUM(jumlah) as transaksi_out FROM transaksi WHERE {$where_clause_for_past} MONTH(tanggal) < '{$past_where_month_clause}' AND YEAR(tanggal) <= '{$past_where_year_clause}' AND tipe_transaksi='expense' AND id_pengguna = {$pengguna_data['id_pengguna']}");

$past_in_data = $past_in_data->fetch_array();
$past_out_data = $past_out_data->fetch_array();

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
$in_data = $in_data['total_in'];
$out_data = $out_data['total_out'];


$past_total = ((int) $past_in_data['transaksi_in'] ?? 0) - ((int) $past_out_data['transaksi_out'] ?? 0);

$total_perhitungan = ($in_data - $out_data) + $past_total;
$fmt = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
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
        <center>
            <?= $judul ?? 'tidak ada judul' ?>
        </center>
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
    <tr>INFO         : <?= $deskripsi ?> </tr><br>
    <tr>GRUP         : <?= $groupName ?> </tr>
    </pre>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th>Tanggal</th>
            <th>Judul Transaksi</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <?php
            while ($row = $transaction_data->fetch_array()) {
                $minus = $row['tipe_transaksi'] == 'income' ? $row['jumlah'] * 1 : $row['jumlah'] * -1;
                echo '<tr>';
                echo '<td>' . (string) $row['tanggal'] . '</td>';
                echo '<td>' . (string) $row['nama'] . '</td>';
                echo '<td>' . (string) $row['deskripsi'] . '</td>';
                echo '<td>' . $fmt->formatCurrency($minus, 'IDR') . '</td>';
                echo '</tr>';
            }
            ?>
        <tr>
            <td colspan="3">Sisa keuangan bulan sebelumnya</td></b>
            <td>
                <?= $fmt->formatCurrency($past_total, 'IDR') ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">Sisa keuangan saat ini</td>
            <td>
                <?= $fmt->formatCurrency($total_perhitungan, 'IDR') ?>
            </td>
        </tr>
    </table>
</body>

</html>