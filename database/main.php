<?php

function mapPengumumanRow($row, $formattedDate = true)
{
    return [
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