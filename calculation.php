<?php
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
require('fpdf/fpdf.php');
$conn = mysqli_connect("localhost", "root", "", "data_saw");

function truncatePerangkingan($conn) {
    $sql = "TRUNCATE TABLE perangkingan";
    if (!mysqli_query($conn, $sql)) {
        die("Error truncating table: " . mysqli_error($conn));
    }
}

if (isset($_POST['proses'])) {
    $bulan = mysqli_real_escape_string($conn, $_POST['bulan']);
    $sql = "SELECT * FROM n_produk WHERE bulan=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bulan);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Mencari nilai max dan min
        $sql = "SELECT MIN(h_jual) AS mHjual, MAX(k_santri) AS mKsantri, MAX(t_penjualan) AS mTpenjualan FROM n_produk WHERE bulan=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bulan);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Mengambil nilai max dan min
        $mHjual = $row["mHjual"];
        $mKsantri = $row["mKsantri"];
        $mTpenjualan = $row["mTpenjualan"];

        // Proses normalisasi
        $sql = "SELECT * FROM n_produk WHERE bulan=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bulan);
        $stmt->execute();
        $result = $stmt->get_result();
        $no = 1;

        // Truncate tabel perangkingan
        truncatePerangkingan($conn);

        while ($row = $result->fetch_assoc()) {
            $iddaftar = $no;
            $hJual = $row["h_jual"];
            $kSantri = $row["k_santri"];
            $tPenjualan = $row["t_penjualan"];

            // Hitung normalisasi
            $nHjual = $mHjual / $hJual;
            $nKsantri = $kSantri / $mKsantri;
            $nTpenjualan = $tPenjualan / $mTpenjualan;

            // Hitung preferensi
            $preferensi = ($nHjual * 0.30) + ($nKsantri * 0.40) + ($nTpenjualan * 0.30);
            $id = $row["id"]; // Perbaikan: gunakan $row untuk mendapatkan 'id' yang benar

            // Simpan data
            $sql = "INSERT INTO perangkingan (id_perangkingan, id, n_harga_jual, n_k_santri, n_t_penjualan, preferensi) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $iddaftar, $id, $nHjual, $nKsantri, $nTpenjualan, $preferensi);
            $stmt->execute();
            $no++;
        }
        header("Location:?page=calculation&bln=$bulan");
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Data tidak ditemukan</strong></div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPK-Saw | Perhitungan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="script.js"></script>
  <link rel="shortcut icon" href="img/logo.jpg">
  <link rel="stylesheet" href="style.css">
  <style>
    .loader {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: 8px solid #f3f3f3;
        border-radius: 50%;
        border-top: 8px solid #3498db;
        width: 60px;
        height: 60px;
        -webkit-animation: spin 0.5s linear infinite;
        animation: spin 0.5s linear infinite;
        z-index: 1000;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .content {
        display: none; /* Hide content until loader disappears */
    }
    td, th {
      vertical-align: middle; /* Center text vertically */
      text-align: center; /* Center text horizontally */
      font-size: 18px; /* Increase font size */
    }
    .diagram {
      text-align: center;
      align-items: center;
      width: 70%;
      display: absolute;
    }
    .konklusi {
        text-align: justify;
    }
  </style>
</head>
<body>
  <div class="loader"></div>
  <div class="sidebar">
    <p>Perhitungan</p>
    <a href="home.php">Home</a>
    <a href="item.php">Produk</a>
    <a href="nilai.php">Nilai Produk</a>
    <a href="criteria.php">Kriteria</a>
    <a href="calculation.php" class="active">Perhitungan</a>
    <a href="akun.php">Akun</a>
    <div><a href="logout.php" style="margin-top: 40vh;">Log out</a></div>
  </div>
  <div class="content">
    <h1>Perhitungan</h1>
    <div class="mb-5">
      <div class="d-flex">
        <form method="post" action="" class="d-flex">
          <select class="form-control me-2" id="bulan" name="bulan" required>
            <option value="">Pilih Bulan</option>
            <?php
            $sql = "SELECT DISTINCT bulan FROM n_produk";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
            <option class="p-2" value="<?php echo htmlspecialchars($row['bulan']); ?>"><?php echo htmlspecialchars($row['bulan']); ?></option>
            <?php
            }
            ?>
          </select>
          <input class="btn btn-primary me-2" type="submit" name="proses" value="Proses">
        </form>
        <form method="post" action="preview.php" target="_blank">
          <input type="hidden" name="bulan" value="<?php echo isset($bulan) ? htmlspecialchars($bulan) : ''; ?>">
          <input class="btn btn-warning" type="submit" name="export" value="Export Laporan">
        </form>
        <form id="export-form">
            <button type="button" class="btn btn-secondary ms-2" onclick="exportPDF()">Export Chart</button>
        </form>

      </div>
    </div>
    <!-- ambil data untuk tabel -->
      <?php
        $no = 1;
        $ambildata = mysqli_query($conn, "SELECT r.id_perangkingan, r.id, n.h_jual, n.k_santri, n.t_penjualan, r.preferensi, n.bulan, p.nama_produk 
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
          LIMIT 10;
        ");

        $products = [];
        $hjual = [];
        $ksantri = [];
        $tpenjualan = [];
        $preferensi = [];

        while ($row = mysqli_fetch_assoc($ambildata)) {
            $products[] = $row['nama_produk'];
            $hjual[] = $row['h_jual'];
            $ksantri[] = $row['k_santri'];
            $tpenjualan[] = $row['t_penjualan'];
            $preferensi[] = $row['preferensi'];
            $bulan = $row['bulan'];  // Ambil bulan dari data pertama
        }
        // Ambil 5 data terakhir
        $sql_last = "SELECT r.id_perangkingan, r.id, n.h_jual, n.k_santri, n.t_penjualan, r.preferensi, n.bulan, p.nama_produk 
        FROM perangkingan r 
        INNER JOIN n_produk n ON r.id = n.id 
        INNER JOIN produk p ON n.id_produk = p.id_produk 
        ORDER BY r.id_perangkingan DESC
        LIMIT 10";

        $ambildata_last = mysqli_query($conn, $sql_last);

        $products_last = [];
        $hjual_last = [];
        $ksantri_last = [];
        $tpenjualan_last = [];
        $preferensi_last = [];

        while ($row_last = mysqli_fetch_assoc($ambildata_last)) {
            $products_last[] = $row_last['nama_produk'];
            $hjual_last[] = $row_last['h_jual'];
            $ksantri_last[] = $row_last['k_santri'];
            $tpenjualan_last[] = $row_last['t_penjualan'];
            $preferensi_last[] = $row_last['preferensi'];
        }
        ?>
    <div class="diagram d-flex flex-column mx-auto justify-content-center">
      <h5>Visualisasi Perangkingan Bulan <?php echo $bulan ?></h5>
      <p>Berikut merupakan visualisasi dari 10 produk yang memiliki score paling baik pada bulan <?php echo $bulan ?></p>
      <canvas class="diagram " id="myChart"></canvas>
      <br>
      <p class="konklusi">Diagram batang di atas menunjukkan bahwa pemilihan produk terbaik di Gambia Department Store didasarkan pada tiga faktor utama: frekuensi penjualan, tingkat kebutuhan santri, dan harga produk. Produk yang memiliki keseimbangan terbaik di antara ketiga faktor ini memperoleh nilai tertinggi. Produk dengan harga yang kompetitif, serta tingkat penjualan dan kebutuhan santri yang tinggi, dinilai sebagai produk terbaik menurut sistem yang telah dikembangkan.
      </p>
    </div>
    <div class="diagram d-flex flex-column mx-auto justify-content-center mt-5">
      <p>Berikut merupakan visualisasi dari 10 produk yang memiliki score terendah <?php echo $bulan ?></p>
      <canvas class="diagram" id="myChartLast"></canvas>
      <br>
      <p class="konklusi">
      Diagram batang di atas menunjukkan produk dengan nilai terendah di Gambia Department Store, yang dipengaruhi oleh tiga faktor utama: frekuensi penjualan, tingkat kebutuhan santri, dan harga produk. Produk yang memiliki nilai rendah umumnya memiliki harga yang kurang kompetitif, penjualan yang rendah, dan tingkat kebutuhan yang tidak terlalu tinggi. Produk-produk ini mungkin perlu dievaluasi kembali, baik dari segi strategi pemasaran maupun pengelolaan stok, untuk menentukan apakah masih layak dipertahankan atau perlu dikurangi stoknya.
      </p>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      const ctx = document.getElementById('myChart').getContext('2d');
      const products = <?php echo json_encode($products); ?>;
      const hjual = <?php echo json_encode($hjual); ?>;
      const ksantri = <?php echo json_encode($ksantri); ?>;
      const tpenjualan = <?php echo json_encode($tpenjualan); ?>;
      const ctxLast = document.getElementById('myChartLast').getContext('2d');
      const productsLast = <?php echo json_encode($products_last); ?>;
      const hjualLast = <?php echo json_encode($hjual_last); ?>;
      const ksantriLast = <?php echo json_encode($ksantri_last); ?>;
      const tpenjualanLast = <?php echo json_encode($tpenjualan_last); ?>;

      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: products,
              datasets: [
                  {
                      label: 'Harga Jual',
                      data: hjual,
                      borderWidth: 1
                  },
                  {
                      label: 'Kebutuhan Santri',
                      data: ksantri,
                      borderWidth: 1
                  },
                  {
                      label: 'Total Penjualan',
                      data: tpenjualan,
                      borderWidth: 1
                  },
              ]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  },
                  x: {
                      ticks: {
                          font: {
                              size: 12
                          }
                      }
                  }
              },
              plugins: {
                  legend: {
                      labels: {
                          font: {
                              size: 12
                          }
                      }
                  }
              }
          }
      });
      new Chart(ctxLast, {
          type: 'bar',
          data: {
              labels: productsLast,
              datasets: [
                  {
                      label: 'Harga Jual',
                      data: hjualLast,
                      borderWidth: 1
                  },
                  {
                      label: 'Kebutuhan Santri',
                      data: ksantriLast,
                      borderWidth: 1
                  },
                  {
                      label: 'Total Penjualan',
                      data: tpenjualanLast,
                      borderWidth: 1
                  },
              ]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  },
                  x: {
                      ticks: {
                          font: {
                              size: 12
                          }
                      }
                  }
              },
              plugins: {
                  legend: {
                      labels: {
                          font: {
                              size: 12
                          }
                      }
                  }
              }
          }
      });
  </script>
  <script> 
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.querySelector('.loader').style.display = 'none';
            document.querySelector('.content').style.display = 'block';
        }, 400);
    });
  </script>
  <script>
    async function exportPDF() {
        const { jsPDF } = window.jspdf;
        const bulan = "<?php echo htmlspecialchars($bulan); ?>";

        // Mengambil gambar dari canvas
        const canvas1 = await html2canvas(document.querySelector("#myChart"));
        const imgData1 = canvas1.toDataURL("image/png");

        const canvas2 = await html2canvas(document.querySelector("#myChartLast"));
        const imgData2 = canvas2.toDataURL("image/png");

        const pdf = new jsPDF('p', 'mm', 'a4'); // Portrait, mm, A4 size

        // Halaman 1: Visualisasi 10 Produk Terbaik
        pdf.setFontSize(12);
        const text1 = `Visualisasi Perangkingan Bulan ${bulan}`;
        const textDesc1 = `Berikut merupakan visualisasi dari 10 produk yang memiliki score paling baik pada bulan ${bulan}`;
        const chartExplanation1 = "Diagram batang di atas menunjukkan bahwa pemilihan produk terbaik di Gambia Department Store didasarkan pada tiga faktor utama: frekuensi penjualan, tingkat kebutuhan santri, dan harga produk. Produk yang memiliki keseimbangan terbaik di antara ketiga faktor ini memperoleh nilai tertinggi. Produk dengan harga yang kompetitif, serta tingkat penjualan dan kebutuhan santri yang tinggi, dinilai sebagai produk terbaik menurut sistem yang telah dikembangkan.";
        
        const pageWidth = pdf.internal.pageSize.width;

        // Menambahkan teks ke halaman 1
        const textWidth1 = pdf.getTextWidth(text1);
        const x1 = (pageWidth - textWidth1) / 2;
        pdf.text(text1, x1, 20);
        
        const textDescWidth1 = pdf.getTextWidth(textDesc1);
        const xDesc1 = (pageWidth - textDescWidth1) / 2;
        pdf.text(textDesc1, xDesc1, 30);

        pdf.addImage(imgData1, 'PNG', 10, 40, 190, 100); // x, y, width, height

        // Menambahkan penjelasan setelah gambar
        pdf.setFontSize(12);
        pdf.text(chartExplanation1, 10, 150, { maxWidth: 190 });

        // Halaman 2: Visualisasi 10 Produk Terendah
        pdf.addPage();
        const text2 = `Visualisasi 10 Produk dengan Score Terendah Bulan ${bulan}`;
        const textDesc2 = `Berikut merupakan visualisasi dari 10 produk yang memiliki score terendah pada bulan ${bulan}`;
        const chartExplanation2 = "Diagram batang di atas menunjukkan produk dengan nilai terendah di Gambia Department Store, yang dipengaruhi oleh tiga faktor utama: frekuensi penjualan, tingkat kebutuhan santri, dan harga produk. Produk yang memiliki nilai rendah umumnya memiliki harga yang kurang kompetitif, penjualan yang rendah, dan tingkat kebutuhan yang tidak terlalu tinggi. Produk-produk ini mungkin perlu dievaluasi kembali, baik dari segi strategi pemasaran maupun pengelolaan stok.";

        const textWidth2 = pdf.getTextWidth(text2);
        const x2 = (pageWidth - textWidth2) / 2;
        pdf.text(text2, x2, 20);
        
        const textDescWidth2 = pdf.getTextWidth(textDesc2);
        const xDesc2 = (pageWidth - textDescWidth2) / 2;
        pdf.text(textDesc2, xDesc2, 30);

        pdf.addImage(imgData2, 'PNG', 10, 40, 190, 100); // x, y, width, height

        // Menambahkan penjelasan setelah gambar
        pdf.setFontSize(12);
        pdf.text(chartExplanation2, 10, 150, { maxWidth: 190 });

        // Simpan PDF dengan nama file yang mencakup bulan
        pdf.save(`Visualisasi Perangkingan Bulan ${bulan}.pdf`);
    }
  </script>


</body>
</html>
