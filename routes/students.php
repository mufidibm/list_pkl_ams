<?php
function getStudents($pdo, $search = '', $batch_id = null, $page = 1, $perPage = 10) {
    $offset = ($page - 1) * $perPage;
    $search = '%' . $search . '%';
    
    $query = "
        SELECT s.*, a.nama_sekolah, b.nama_batch 
        FROM siswa s 
        JOIN asal_sekolah a ON s.asal_sekolah_id = a.id 
        JOIN batch b ON s.batch_id = b.id 
        WHERE (s.nama_lengkap LIKE :search OR s.nama_panggilan LIKE :search OR a.nama_sekolah LIKE :search OR b.nama_batch LIKE :search)
    ";
    
    $params = [':search' => $search];
    
    if ($batch_id !== null) {
        $query .= " AND s.batch_id = :batch_id";
        $params[':batch_id'] = $batch_id;
    }
    
    $query .= " ORDER BY a.nama_sekolah LIMIT :perPage OFFSET :offset";
    
    $stmt = $pdo->prepare($query);
    
    // Bind string parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    // Bind LIMIT and OFFSET as integers
    $stmt->bindValue(':perPage', (int)$perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalStudents($pdo, $search = '', $batch_id = null) {
    $search = '%' . $search . '%';
    $query = "
        SELECT COUNT(*) 
        FROM siswa s 
        JOIN asal_sekolah a ON s.asal_sekolah_id = a.id 
        JOIN batch b ON s.batch_id = b.id 
        WHERE (s.nama_lengkap LIKE :search OR s.nama_panggilan LIKE :search OR a.nama_sekolah LIKE :search OR b.nama_batch LIKE :search)
    ";
    
    $params = [':search' => $search];
    
    if ($batch_id !== null) {
        $query .= " AND s.batch_id = :batch_id";
        $params[':batch_id'] = $batch_id;
    }
    
    $stmt = $pdo->prepare($query);
    
    // Bind parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getStudent($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM siswa WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function createStudent($pdo, $data) {
    $sql = "INSERT INTO siswa (nama_lengkap, jenis_kelamin, nama_panggilan, tempat_lahir, tanggal_lahir, alamat, periode_mulai, periode_selesai, no_telepon, email, keterangan, batch_id, asal_sekolah_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $data['nama_lengkap'], 
        $data['jenis_kelamin'] ?? null,
        $data['nama_panggilan'] ?? null,
        $data['tempat_lahir'] ?? null,
        $data['tanggal_lahir'] ?? null,
        $data['alamat'] ?? null,
        $data['periode_mulai'] ?? null,
        $data['periode_selesai'] ?? null,
        $data['no_telepon'] ?? null,
        $data['email'] ?? null,
        $data['keterangan'] ?? null,
        $data['batch_id'],
        $data['asal_sekolah_id']
    ]);
}

function updateStudent($pdo, $id, $data) {
    $sql = "UPDATE siswa SET nama_lengkap = ?, jenis_kelamin = ?, nama_panggilan = ?, tempat_lahir = ?, tanggal_lahir = ?, alamat = ?, periode_mulai = ?, periode_selesai = ?, no_telepon = ?, email = ?, keterangan = ?, batch_id = ?, asal_sekolah_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $data['nama_lengkap'], 
        $data['jenis_kelamin'] ?? null,
        $data['nama_panggilan'] ?? null,
        $data['tempat_lahir'] ?? null,
        $data['tanggal_lahir'] ?? null,
        $data['alamat'] ?? null,
        $data['periode_mulai'] ?? null,
        $data['periode_selesai'] ?? null,
        $data['no_telepon'] ?? null,
        $data['email'] ?? null,
        $data['keterangan'] ?? null,
        $data['batch_id'],
        $data['asal_sekolah_id'],
        $id
    ]);
}

function deleteStudent($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM siswa WHERE id = ?");
    return $stmt->execute([$id]);
}