<?php

$basePath = __DIR__;
require_once $basePath . '/../../Connections/conn.php';

if (isset($_POST['action']) || isset($_GET['action'])) {
    $action = isset($_POST['action']) ? $_POST['action'] : $_GET['action'];

    switch ($action) {
        case 'create':
            create();
            break;
        case 'delete':
            delete();
            break;
        case 'edit':
            getById();
            break;
        case 'update':
            update();
            break;
        case 'detail':
            detail();
            break;
        default:
            break;
    }
}

function detail()
{
    global $conn;

    $id_jenis = $_GET['id_jenis'];

    $query = "SELECT objek_wisata.*, jenis_wisata.nama as nama_jenis, jenis_wisata.id as id_jenis_wisata
              FROM objek_wisata 
              LEFT JOIN jenis_wisata ON objek_wisata.id_jenis = jenis_wisata.id 
              WHERE objek_wisata.id_jenis = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_jenis);
    $stmt->execute();
    $result = $stmt->get_result();

    $query_jenis = "SELECT * FROM jenis_wisata WHERE id = ?";
    $stmt_jenis = $conn->prepare($query_jenis);
    $stmt_jenis->bind_param("i", $id_jenis);
    $stmt_jenis->execute();
    $jenis = $stmt_jenis->get_result();

    return [
        'result' => $result,
        'jenis' => $jenis
    ];
}

function create()
{
    global $conn;

    $req_nama = $_POST['nama'];
    $req_deskripsi = $_POST['deskripsi'];
    $req_jenis = $_POST['jenis'];

    $nama = $conn->real_escape_string($req_nama);
    $deskripsi = $conn->real_escape_string($req_deskripsi);
    $jenis = $conn->real_escape_string($req_jenis);

    $fotoBase64 = base64_encode(file_get_contents($_FILES['foto']['tmp_name']));
    $fotoBase64 = 'data:image/jpeg;base64,' . $fotoBase64;

    $query = "INSERT INTO objek_wisata (nama, id_jenis, deskripsi, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nama, $jenis, $deskripsi, $fotoBase64);
    $result = $stmt->execute();
    session_start();

    if ($result) {
        $_SESSION['message'] = 'Data berhasil disimpan!';
        header('Location: ../wisata');
    } else {
        $_SESSION['message'] = 'Error: Data gagal disimpan.';
        header('Location: ../tambah');
    }

    session_write_close();
}

function getAll()
{
    global $conn;

    $query = "SELECT objek_wisata.*, jenis_wisata.nama as nama_jenis 
              FROM objek_wisata 
              LEFT JOIN jenis_wisata ON objek_wisata.id_jenis = jenis_wisata.id";

    $result = $conn->query($query);

    return $result;
}

function getById()
{
    global $conn;

    $id = $_GET['id'];

    $query = "SELECT objek_wisata.*, jenis_wisata.nama as nama_jenis, jenis_wisata.id as id_jenis 
              FROM objek_wisata 
              LEFT JOIN jenis_wisata ON objek_wisata.id_jenis = jenis_wisata.id 
              WHERE objek_wisata.id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}

function getJenis()
{
    global $conn;

    $query = "SELECT * FROM jenis_wisata";
    $result = $conn->query($query);

    return $result;
}

function update()
{
    global $conn;

    $id = $_POST['id'];
    $req_nama = $_POST['nama'];
    $req_deskripsi = $_POST['deskripsi'];
    $req_jenis = $_POST['jenis'];

    $nama = $conn->real_escape_string($req_nama);
    $deskripsi = $conn->real_escape_string($req_deskripsi);
    $jenis = $conn->real_escape_string($req_jenis);

    if (!empty($_FILES['foto']['tmp_name'])) {
        $fotoBase64 = base64_encode(file_get_contents($_FILES['foto']['tmp_name']));
        $fotoBase64 = 'data:image/jpeg;base64,' . $fotoBase64;
        $query = "UPDATE objek_wisata SET nama=?, id_jenis=?, deskripsi=?, foto=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $nama, $jenis, $deskripsi, $fotoBase64, $id);
    } else {
        $query = "UPDATE objek_wisata SET nama=?, id_jenis=?, deskripsi=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $nama, $jenis, $deskripsi, $id);
    }

    $result = $stmt->execute();

    session_start();

    if ($result) {
        $_SESSION['message'] = 'Data berhasil diupdate!';
        header('Location: ../wisata');
    } else {
        $_SESSION['message'] = 'Error: Data gagal diupdate.';
        header('Location: ../edit?action=edit&id=' . $id);
    }

    session_write_close();
}

function delete()
{
    global $conn;

    $id = $_GET['id'];

    $query = "DELETE FROM objek_wisata WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    session_start();

    if ($result) {
        $_SESSION['message'] = 'Data berhasil dihapus!';
        header('Location: ../wisata');
    } else {
        $_SESSION['message'] = 'Error: Data gagal dihapus.';
        header('Location: ../wisata');
    }

    session_write_close();
}
?>
