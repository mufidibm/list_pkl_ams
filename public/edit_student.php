<?php
require_once '../config/database.php';
require_once '../routes/students.php';
require_once '../routes/batches.php';
require_once '../routes/schools.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$student = getStudent($pdo, $_GET['id']);
if (!$student) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateStudent($pdo, $_GET['id'], $_POST);
    header('Location: index.php');
    exit;
}

$batches = getBatches($pdo);
$schools = getSchools($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="date"],
select,
textarea {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

</style>
<body>
 <div class="container">
    <h2>Edit Siswa</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($student['nama_lengkap']) ?>" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= $student['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $student['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Nama Panggilan:</label>
            <input type="text" name="nama_panggilan" value="<?= htmlspecialchars($student['nama_panggilan'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($student['tempat_lahir'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" value="<?= $student['tanggal_lahir'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>Alamat:</label>
            <input type="text" name="alamat" value="<?= htmlspecialchars($student['alamat'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Periode Mulai:</label>
            <input type="date" name="periode_mulai" value="<?= $student['periode_mulai'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>Periode Selesai:</label>
            <input type="date" name="periode_selesai" value="<?= $student['periode_selesai'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>No Telepon:</label>
            <input type="text" name="no_telepon" value="<?= htmlspecialchars($student['no_telepon'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($student['email'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Status:</label>
            <input type="text" name="status" value="<?= htmlspecialchars($student['status'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Keterangan:</label>
            <textarea name="keterangan"><?= htmlspecialchars($student['keterangan'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Asal Sekolah:</label>
            <select name="asal_sekolah_id" required>
                <option value="">Pilih Sekolah</option>
                <?php foreach ($schools as $school): ?>
                    <option value="<?= $school['id'] ?>" <?= $school['id'] == $student['asal_sekolah_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($school['nama_sekolah']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Batch:</label>
            <select name="batch_id" required>
                <option value="">Pilih Batch</option>
                <?php foreach ($batches as $batch): ?>
                    <option value="<?= $batch['id'] ?>" <?= $batch['id'] == $student['batch_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($batch['nama_batch']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="index.php" class="btn-danger" style="text-decoration:none; padding: 8px 14px;">Batal</a>
        </div>
    </form>
</div>

            <label>Asal Sekolah:</label><br>
            <select name="asal_sekolah_id" required>
                <option value="">Pilih Sekolah</option>
                <?php foreach ($schools as $school): ?>
                    <option value="<?= $school['id'] ?>" <?= $school['id'] == $student['asal_sekolah_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($school['nama_sekolah']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            
            <label>Batch:</label><br>
            <select name="batch_id" required>
                <option value="">Pilih Batch</option>
                <?php foreach ($batches as $batch): ?>
                    <option value="<?= $batch['id'] ?>" <?= $batch['id'] == $student['batch_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($batch['nama_batch']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="index.php"><button type="button" class="btn-danger">Batal</button></a>
        </form>
    </div>
</body>
</html>