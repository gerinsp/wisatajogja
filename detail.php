<?php

$basePath = __DIR__;
require_once 'admin/service/main_service.php';

$result = detail();

$resultJenis = mysqli_fetch_assoc($result['jenis']);

include 'template/header.php';
?>

<div class="text-center">
    <h1><?php echo ucwords(strtolower($resultJenis['nama'])) ?></h1>
</div>

<div id="content">
    <?php if ($result['result']) {
        while ($row = mysqli_fetch_assoc($result['result'])) {
            ?>
            <div class="card" style="width: 415px;">
                <header>
                    <h2><?php echo $row['nama'] ?></h2>
                    <img src="<?php echo $row['foto'] ?>" alt="">
                </header>
                <section>
                    <h3>Deskripsi Singkat</h3>
                    <p><?php echo $row['deskripsi'] ?></p>
                </section>
            </div>
            <?php
        }
    }
    ?>
</div>

<?php include 'template/footer.php'; ?>
