<?php
function getBatches($pdo) {
    $stmt = $pdo->query("SELECT * FROM batch");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createBatch($pdo, $nama_batch) {
    $stmt = $pdo->prepare("INSERT INTO batch (nama_batch) VALUES (?)");
    return $stmt->execute([$nama_batch]);
}

function deleteBatch($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM batch WHERE id = ?");
    return $stmt->execute([$id]);
}
?>