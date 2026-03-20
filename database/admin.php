<?php

function getAkunAdmin($conn, $username)
{
    $sql = "SELECT username, password FROM admin WHERE username = ?"; // Only fetch necessary fields
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

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
            $pengumuman[] = mapPengumumanRow($row, false);
        }
    }

    return $pengumuman;
}