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
        return mapPengumumanRow($row, false);
    }

    $stmt->close();
    return null;
}

function generateSlug($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/\s+/', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    $text = trim($text, '-');

    if ($text === '') {
        return 'pengumuman';
    }

    return $text;
}

function slugExists($conn, $slug, $excludeSlug = null)
{
    $sql = "SELECT slug FROM pengumuman WHERE slug = ?";
    if ($excludeSlug !== null) {
        $sql .= " AND slug != ?";
    }
    $sql .= " LIMIT 1";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    if ($excludeSlug !== null) {
        $stmt->bind_param("ss", $slug, $excludeSlug);
    } else {
        $stmt->bind_param("s", $slug);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result && $result->num_rows > 0;
    $stmt->close();

    return $exists;
}

function createUniqueSlug($conn, $judul, $excludeSlug = null)
{
    $baseSlug = generateSlug($judul);
    $slug = $baseSlug;
    $counter = 1;

    while (slugExists($conn, $slug, $excludeSlug)) {
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }

    return $slug;
}

function tambahPengumuman($conn, $data)
{
    $slug = createUniqueSlug($conn, $data['judul']);

    $sql = "INSERT INTO pengumuman (judul, slug, tanggal, deskripsi, belum_dibaca, kategori) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssssis",
        $data['judul'],
        $slug,
        $data['tanggal'],
        $data['deskripsi'],
        $data['belum_dibaca'],
        $data['kategori']
    );

    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function updatePengumuman($conn, $oldSlug, $data)
{
    $newSlug = createUniqueSlug($conn, $data['judul'], $oldSlug);

    $sql = "UPDATE pengumuman SET judul = ?, slug = ?, tanggal = ?, deskripsi = ?, belum_dibaca = ?, kategori = ? WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "ssssiss",
        $data['judul'],
        $newSlug,
        $data['tanggal'],
        $data['deskripsi'],
        $data['belum_dibaca'],
        $data['kategori'],
        $oldSlug
    );

    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function hapusPengumuman($conn, $slug)
{
    $sql = "DELETE FROM pengumuman WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("s", $slug);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}