<?php
require_once '../config/database.php';
require_once '../routes/students.php';
require_once '../routes/batches.php';
require_once '../routes/schools.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_batch'])) {
        createBatch($pdo, $_POST['nama_batch']);
    } elseif (isset($_POST['add_school'])) {
        createSchool($pdo, $_POST['nama_sekolah']);
    } elseif (isset($_POST['delete_batch'])) {
        deleteBatch($pdo, $_POST['batch_id']);
    } elseif (isset($_POST['delete_school'])) {
        deleteSchool($pdo, $_POST['school_id']);
    }
}

// Handle search and pagination
$search = $_GET['search'] ?? '';
$batch_id = isset($_GET['batch_id']) && $_GET['batch_id'] !== '' ? (int)$_GET['batch_id'] : null;
$page = (int)($_GET['page'] ?? 1);
$perPage = 10;

$students = getStudents($pdo, $search, $batch_id, $page, $perPage);
$totalStudents = getTotalStudents($pdo, $search, $batch_id);
$totalPages = ceil($totalStudents / $perPage);

$batches = getBatches($pdo);
$schools = getSchools($pdo);

// Helper tanggal
function tanggalIndo($tanggal, $withDay = true) {
    if (!$tanggal) return '-';

    $bulanIndo = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $tgl = date('d', strtotime($tanggal));
    $bln = (int)date('m', strtotime($tanggal));
    $thn = date('Y', strtotime($tanggal));

    return $withDay ? "$tgl {$bulanIndo[$bln]} $thn" : "{$bulanIndo[$bln]} $thn";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manajemen PKL AMS</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f9fb;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #2c3e50;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-form input[type="text"],
        .search-form select {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            flex: 1;
        }

        .search-form button {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow-x: auto;
            display: block;
        }

        table th, table td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
            max-width: 200px;
        }

        table th {
            background-color: #f0f4f8;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table td, table th {
            font-size: 14px;
        }

        table td {
            white-space: normal;
            word-break: break-word;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #3498db;
        }

        .pagination a:hover {
            text-decoration: underline;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0; top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px 30px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .modal-content h3 {
            margin-top: 0;
            text-align: center;
        }

        .modal-content input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            width: 100%;
            padding: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 22px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manajemen Data Siswa PKL</h2>

        <!-- Search Form -->
        <form method="GET" class="search-form">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari nama, sekolah, atau batch...">
            <select name="batch_id">
                <option value="">Semua Batch</option>
                <?php foreach ($batches as $batch): ?>
                    <option value="<?= $batch['id'] ?>" <?= $batch_id === $batch['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($batch['nama_batch']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-primary">Cari</button>
            <?php if ($search || $batch_id !== null): ?>
                <a href="index.php"><button type="button" class="btn-danger">Reset</button></a>
            <?php endif; ?>
        </form>

        <!-- Add Student & Modals -->
        <a href="add_student.php"><button class="btn-primary">Tambah Siswa</button></a>
        <button onclick="openModal('batchModal')" class="btn-primary">Tambah Batch</button>
        <button onclick="openModal('schoolModal')" class="btn-primary">Tambah Sekolah</button>

        <!-- Batch Modal -->
        <div id="batchModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('batchModal')">&times;</span>
                <h3>Tambah Batch</h3>
                <form method="POST">
                    <input type="text" name="nama_batch" required placeholder="Nama Batch">
                    <button type="submit" name="add_batch" class="btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <!-- School Modal -->
        <div id="schoolModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('schoolModal')">&times;</span>
                <h3>Tambah Sekolah</h3>
                <form method="POST">
                    <input type="text" name="nama_sekolah" required placeholder="Nama Sekolah">
                    <button type="submit" name="add_school" class="btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <table>
            <tr>
                <th>Nama Lengkap</th>
                <th>Nama Panggilan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tgl Lahir</th>
                <th>Alamat</th>
                <th>Periode</th>
                <th>No Telepon</th>
                <th>Email</th>
                <th>Keterangan</th>
                <th>Asal Sekolah</th>
                <th>Batch</th>
                <th>Aksi</th>
            </tr>
            <?php if (empty($students)): ?>
                <tr><td colspan="12">Tidak ada data ditemukan.</td></tr>
            <?php else: ?>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($student['nama_panggilan'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($student['jenis_kelamin'] ?? '-') ?></td>
                    <td><?= htmlspecialchars(($student['tempat_lahir'] ?? '-') . ', ' . tanggalIndo($student['tanggal_lahir'])) ?></td>
                    <td><?= htmlspecialchars($student['alamat'] ?? '-') ?></td>
                    <td><?= htmlspecialchars(tanggalIndo($student['periode_mulai']) . ' s/d ' . tanggalIndo($student['periode_selesai'])) ?></td>
                    <td><?= htmlspecialchars($student['no_telepon'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($student['email'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($student['keterangan'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($student['nama_sekolah']) ?></td>
                    <td><?= htmlspecialchars($student['nama_batch']) ?></td>
                    <td>
                        <a href="edit_student.php?id=<?= $student['id'] ?>"><button class="btn-primary">Edit</button></a>
                        <form method="POST" action="../routes/students.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $student['id'] ?>">
                               <button type="submit" name="delete_student" class="btn-danger" onclick="return confirmDelete('Yakin ingin menghapus siswa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <p>Halaman:
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="index.php?page=<?= $i ?>&search=<?= urlencode($search) ?>&batch_id=<?= $batch_id ?? '' ?>" style="<?= $i === $page ? 'font-weight: bold;' : '' ?>">
                    <?= $i ?>
                </a><?= $i < $totalPages ? ' |' : '' ?>
            <?php endfor; ?>
            </p>
            <p>Total Siswa: <?= $totalStudents ?></p>
        </div>
        <?php endif; ?>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
        }
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
</body>
</html>
