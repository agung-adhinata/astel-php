<?php
require_once '../config.php';
header('Content-type: application/json');
// Menampilkan json traksaksi ketika memilih menu keuangan
// jika akun belum login
if (!isset($_SESSION['user_id'])) {
  $response = [
    'error' => true,
    'message' => 'user not authenticated'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}

// harus akun pengguna
$pengguna_data = $_db->query("SELECT id_pengguna from pengguna where id_akun = {$_SESSION['user_id']}");

if (!$pengguna_data or mysqli_num_rows($pengguna_data) < 1) {
  $response = [
    'error' => true,
    'message' => 'You\'re not a pengguna'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}

$where_clause = "";
$where_clause_for_past = "";
$past_where_month_clause = null;
$past_where_year_clause = null;
// Main fetching
if (isset($_GET['date']) or isset($_GET['search']) or isset($_GET['group'])) {
  $query = array();
  $query2 = array();
  if (isset($_GET['date'])) {
    $temp = explode('-', $_GET['date']);
    $year = (int) $temp[0];
    $month = (int) $temp[1];

    $past_where_month_clause = $month;
    $past_where_year_clause = $year;
    array_push($query, "MONTH(tanggal) = '{$month}' AND YEAR(tanggal) = '{$year}'");
  }
  if (isset($_GET['search'])) {
    $search = $_GET['search'];
    array_push($query, "nama LIKE '%{$search}%'");
    array_push($query2, "nama LIKE '%{$search}%'");
  }
  if (isset($_GET['group'])) {
    $group = $_GET['group'];
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
$past_where_month_clause = $past_where_month_clause ?? 'MONTH(NOW())';
$past_where_year_clause = $past_where_year_clause ?? 'YEAR(NOW())';
$pengguna_data = $pengguna_data->fetch_array();

$transaction_data = $_db->query("SELECT * FROM transaksi WHERE {$where_clause} id_pengguna = {$pengguna_data['id_pengguna']} ORDER BY tanggal DESC");

$past_in_data = $_db->query("SELECT SUM(jumlah) as transaksi_in FROM transaksi WHERE {$where_clause_for_past} MONTH(tanggal) < '{$past_where_month_clause}' AND YEAR(tanggal) <= '{$past_where_year_clause}' AND tipe_transaksi='income' AND id_pengguna = {$pengguna_data['id_pengguna']}");
$past_out_data = $_db->query("SELECT SUM(jumlah) as transaksi_out FROM transaksi WHERE {$where_clause_for_past} MONTH(tanggal) < '{$past_where_month_clause}' AND YEAR(tanggal) <= '{$past_where_year_clause}' AND tipe_transaksi='expense' AND id_pengguna = {$pengguna_data['id_pengguna']}");

if (!$past_in_data or !$past_out_data) {
  $response = [
    'error' => true,
    'message' => "Server error: {$_db->error}",
    'stacktrace' => "{$where_clause}"
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
}
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
} else {
  $transactions = [];
  while ($row = $transaction_data->fetch_assoc()) {
    $transactions[] = $row;
  }
  $total = ((int) $in_data["total_in"] ?? 0) - ((int) $out_data["total_out"] ?? 0);
  $past_total = ((int) $past_in_data['transaksi_in'] ?? 0) - ((int) $past_out_data['transaksi_out'] ?? 0);
  $response = [
    "transactions" => $transactions,
    "total_income" => $in_data["total_in"] ?? 0,
    "total_expense" => $out_data["total_out"] ?? 0,
    "past_total" => $past_total ?? 0,
    "total" => $total
  ];
  echo json_encode($response);
  exit;
}