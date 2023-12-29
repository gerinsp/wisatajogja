<?php

$basePath = __DIR__;
require_once 'admin/service/main_service.php';

$result = getJenis();

include 'template/header.php';
?>

<div class="marque">
    <marquee behavior="scroll" direction="left">
        Welcome to wisata yogyakarta
    </marquee>
</div>
<div class="jumbotron" style="padding: 0px;">
    <img src="public/assets/image/jogja2.jpg" title="Kota Jogja" width="100%" alt="logo" />
</div>

<div id="content">
    <?php if ($result) {
        while ($row = mysql_fetch_assoc($result)) {
    ?>
    <div class="card" style="width: 415px;">
        <header>
            <h2><?php echo $row['nama'] ?></h2>
            <img src="public/assets/image/<?php echo $row['img'] ?>" alt="">
        </header>
        <section>
            <a class="button" href="detail?action=detail&id_jenis=<?php echo $row['id'] ?>">Lihat detail >></a>
        </section>
    </div>
    <?php
        }
    }
    ?>
</div>

<?php include 'template/footer.php'; ?>
