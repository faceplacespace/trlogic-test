<?php require_once 'header.view.php'; ?>

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title"><?=$this->dict['signin']?></h2>
                <?=components\FlashMessages::show();?>
                <form method="POST" action="/auth">
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="<?=$this->dict['email']?>" name="email">
                    </div>
                    <div class="input-group">
                        <input class="input--style-1" type="password" placeholder="<?=$this->dict['password']?>" name="password">
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--green" type="submit"><?=$this->dict['signin']?></button>
                    </div>
                </form>
                <a href="/signup" class="bottom-link"><?=$this->dict['signup']?></a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.view.php'; ?>