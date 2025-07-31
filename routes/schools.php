<?php
function getSchools($pdo) {
    $stmt = $pdo->query("SELECT * FROM asal_sekolah");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createSchool($pdo, $nama_sekolah) {
    $stmt = $pdo->prepare("INSERT INTO asal_sekolah (nama_sekolah) VALUES (?)");
    return $stmt->execute([$nama_sekolah]);
}

function deleteSchool($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM asal_sekolah WHERE id = ?");
    return $stmt->execute([$id]);
}

?>