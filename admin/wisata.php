<?php

$basePath = __DIR__;
require_once 'service/main_service.php';

$result = getAll();

include 'template/header.php';
?>

<div id="content">
    <h2>Data Wisata</h2>

    <?php
     if (isset($_SESSION['message']))  {
    ?>
        <div class="alert alert-success">
            <span class="alert-close" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $_SESSION['message']; ?>
        </div>
    <?php
     unset($_SESSION['message']);
     }
    ?>

    <a href="tambah" class="btn blue">Tambah</a>
    <table class="data-table" id="data-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nama Wisata</th>
            <th>Jenis Wisata</th>
            <th width="40%">Deskripsi</th>
            <th width="15%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
         if ($result) {
             $i = 1;
             while ($row = mysqli_fetch_assoc($result)) {
         ?>
            <tr>
               <td><?php echo $i++ ?></td>
               <td><img style="width: 60px;" src="<?php echo $row['foto'] ?>" alt="gambar objek wisata" /></td>
               <td><?php echo $row['nama'] ?></td>
               <td><?php echo $row['nama_jenis'] ?></td>
               <td><?php echo $row['deskripsi'] ?></td>
               <td>
                   <a href="edit?action=edit&id=<?php echo $row['id'] ?>" class="btn yellow">Edit</a>
                   <a href="service/main_service.php?action=delete&id=<?php echo $row['id'] ?>" class="btn red" onclick="confirm('Apakah anda yakin akan menghapus data?')">Delete</a>
               </td>
            </tr>
         <?php
             }
         }
        ?>

        </tbody>
    </table>
    <?php
         if (mysqli_num_rows($result) == 0) { ?>
        <p style="text-align: center">Tidak ada data.</p>
    <?php } ?>
</div>

<?php include 'template/footer.php' ?>
