<?php require_once 'header.view.php'; ?>

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w400">
            <div class="card card-1">
                <div class="profile-card">
                    <div class="img-profile">
                        <img src="<?= ($user['image'] ?? '../public/assets/images/nophoto.png') ?>">
                    </div>
                    <div class="profile-info">
                        <h1 class="title"><?= $user['username'] ?></h1>
                        <h4><?= $user['email'] ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once 'footer.view.php'; ?>