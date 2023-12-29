<?php
$basePath = __DIR__;
require_once 'service/main_service.php';

$result = getById();
$row = mysql_fetch_assoc($result);

$jenis = getJenis();

include 'template/header.php';
?>

<div id="content">
    <h2>Edit Data</h2>
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
                <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="action" id="action" value="update">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Wisata</label>
                    <select name="jenis" id="jenis" class="form-control" required>
                        <option value=""></option>
                        <?php
                        if ($jenis) {
                            while ($val = mysql_fetch_assoc($jenis)) { ?>
                                <?php if ($val['id'] == $row['id_jenis']) { ?>
                                    <option value="<?php echo $val['id'] ?>" selected><?php echo $val['nama'] ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $val['id'] ?>"><?php echo $val['nama'] ?></option>
                                <?php } ?>
                        <?php
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $row['deskripsi'] ?></textarea>
                </div>
                <img id="images" style="width: 200px" src="<?php echo $row['foto'] ?>" alt="gambar objek wisata">
                <div id="image-preview"></div>
                <div class="form-group">
                    <label for="foto">Image</label>
                    <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage(this)">
                </div>
                <button type="submit" class="btn blue">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>

