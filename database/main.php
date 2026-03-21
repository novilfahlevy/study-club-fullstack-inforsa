<?php

function getAkunUser($conn, $username)
{
    $sql = "SELECT id, username, password FROM pengguna WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

function getAkunUserById($conn, $id)
{
    $sql = "SELECT id, username, password FROM pengguna WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

function mapPengumumanRow($row, $formattedDate = true)
{
    return [
        'id' => $row['id'],
        'judul' => $row['judul'],
        'slug' => $row['slug'],
        'tanggal' => $formattedDate ? date('d F Y', strtotime($row['tanggal'])) : $row['tanggal'],
        'deskripsi' => $row['deskripsi'],
        'belum_dibaca' => $row['belum_dibaca'],
        'kategori' => $row['kategori']
    ];
}

function getPengumuman($conn)
{
    $sql = "SELECT * FROM pengumuman ORDER BY tanggal DESC";
    $result = $conn->query($sql);
    $pengumuman = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pengumuman[] = mapPengumumanRow($row, true);
        }
    }

    return $pengumuman;
}

function getPengumumanByKategori($conn, $kategori)
{
    $sql = "SELECT * FROM pengumuman WHERE kategori = ? ORDER BY tanggal DESC";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return [];
    }

    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $pengumuman = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pengumuman[] = mapPengumumanRow($row, true);
        }
    }

    $stmt->close();
    return $pengumuman;
}

function getPengumumanBySlug($conn, $slug)
{
    $sql = "SELECT * FROM pengumuman WHERE slug = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        return mapPengumumanRow($row, true);
    }

    $stmt->close();
    return null;
}

function tambahKomentar($conn, $pengumumanId, $penggunaId, $komentar)
{
    $sql = "INSERT INTO komentar (pengumuman_id, pengguna_id, komentar) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("iis", $pengumumanId, $penggunaId, $komentar);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}

function getKomentarPengumuman($conn, $pengumumanId)
{
    $sql = "SELECT komentar, pengguna_id FROM komentar WHERE pengumuman_id = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return [];
    }

    $stmt->bind_param("i", $pengumumanId);
    $stmt->execute();
    $result = $stmt->get_result();
    $komentar = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $akunUser = getAkunUserById($conn, $row['pengguna_id']);
            $komentar[] = [
                'username' => $akunUser['username'],
                'komentar' => $row['komentar']
            ];
        }
    }

    $stmt->close();
    return $komentar;
}