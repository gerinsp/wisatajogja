<?php
$basePath = __DIR__;
require_once 'service/main_service.php';

$result = getJenis();

include 'template/header.php';
?>

<div id="content">
    <h2>Tambah Data</h2>

    <?php
    if (isset($_SESSION['message']))  {
        ?>
        <div class="alert alert-danger">
            <span class="alert-close" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
    }
    ?>

    <div class="card">
        <div class="card-body">
            <form action="service/main_service.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Wisata</label>
                    <select name="jenis" id="jenis" class="form-control" required>
                        <option value=""></option>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>
                <div id="image-preview"></div>
                <div class="form-group">
                    <label for="foto">Image</label>
                    <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(this)" required>
                </div>
                <button type="submit" class="btn blue">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>
