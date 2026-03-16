<?php

function getPengumuman($conn) {
    $sql = "SELECT * FROM pengumuman ORDER BY tanggal DESC";
    $result = $conn->query($sql);
    $pengumuman = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pengumuman[] = [
                'judul' => $row['judul'],
                'slug' => $row['slug'],
                'tanggal' => date('d F Y', strtotime($row['tanggal'])),
                'deskripsi' => $row['deskripsi'],
                'belum_dibaca' => $row['belum_dibaca'],
                'kategori' => $row['kategori']
            ];
        }
    }

    return $pengumuman;
}

function getPengumumanByKategori($conn, $kategori) {
    $sql = "SELECT * FROM pengumuman WHERE kategori = '$kategori' ORDER BY tanggal DESC";
    $result = $conn->query($sql);
    $pengumuman = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pengumuman[] = [
                'judul' => $row['judul'],
                'slug' => $row['slug'],
                'tanggal' => date('d F Y', strtotime($row['tanggal'])),
                'deskripsi' => $row['deskripsi'],
                'belum_dibaca' => $row['belum_dibaca'],
                'kategori' => $row['kategori']
            ];
        }
    }

    return $pengumuman;
}

function getPengumumanBySlug($conn, $slug) {
    $sql = "SELECT * FROM pengumuman WHERE slug = '$slug'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return [
            'judul' => $row['judul'],
            'tanggal' => date('d F Y', strtotime($row['tanggal'])),
            'deskripsi' => $row['deskripsi'],
            'belum_dibaca' => $row['belum_dibaca'],
            'kategori' => $row['kategori']
        ];
    }

    return null;
}