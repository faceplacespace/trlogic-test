<?php require_once 'header.view.php'; ?>

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <?php if(isset($_SESSION['user'])): ?>
    <a href="/logout" class="logout">Logout</a>
    <?php endif; ?>
    <div class="wrapper wrapper--w400">
        <div class="card card-1">
            <div class="profile-card">
                <div class="img-profile">
                    <img src="https://sun9-3.userapi.com/c629501/v629501288/f148/2lAseo_ptwc.jpg">
                </div>
                <div class="profile-info">
                    <h1 class="title">Username</h1>
                    <h3><?=$user['email']?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.view.php'; ?>