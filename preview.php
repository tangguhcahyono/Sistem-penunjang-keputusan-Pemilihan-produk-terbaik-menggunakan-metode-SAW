<?php
include "config.php"; // Make sure this file contains your database connection setup

// ambil data
$sql = "SELECT 
    r.id_perangkingan, r.id, n.h_jual, n.k_santri, n.t_penjualan, r.preferensi, n.bulan, p.nama_produk 
FROM 
    perangkingan r 
INNER JOIN 
    n_produk n 
ON 
    r.id = n.id 
INNER JOIN 
    produk p 
ON 
    n.id_produk = p.id_produk 
ORDER BY 
    r.preferensi DESC
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the first row to get the month
    $row = $result->fetch_assoc();
    $bulan = $row['bulan'];
    $fileName = "laporan-excel-" . $bulan . ".xls";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=" . $fileName); 
    // Reset the result pointer and fetch all rows
    $result->data_seek(0);

    echo '<p align="center" style="font-weight:bold;font-size:16pt">Laporan data bulan ' . $bulan . '</p>';
    echo '<table border="1" align="center">';
    echo '<tr>
        <th width="50">No</th>
        <th width="200">Nama Barang</th>
        <th width="100">Kebutuhan Santri</th>
        <th width="100">Harga Jual</th>
        <th width="100">Total Penjualan</th>
        <th width="100">Nilai Preferensi</th>
    </tr>';

    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
            <td align="center">' . $no . '</td>
            <td>' . $row['nama_produk'] . '</td>
            <td align="right">' . number_format($row['k_santri'], 0, ',', '.') . '</td>
            <td align="right">' . number_format($row['h_jual'], 0, ',', '.') . '</td>
            <td align="right">' . number_format($row['t_penjualan'], 0, ',', '.') . '</td>
            <td align="right">' . $row['preferensi'] . '</td>
        </tr>';
        $no++;
    }

    echo '</table>';
} else {
    echo '<p align="center">No data available</p>';
}
exit;
?>
