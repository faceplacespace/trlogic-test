<?php require_once 'header.view.php'; ?>

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title"><?= $this->dict['signup'] ?></h2>
                    <?= components\FlashMessages::show(); ?>
                    <form method="POST" action="/create" id="signup">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="<?= $this->dict['email'] ?>"
                                   name="email">
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="<?= $this->dict['username'] ?>"
                                   name="username">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="password"
                                           placeholder="<?= $this->dict['password'] ?>" name="password">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="password"
                                           placeholder="<?= $this->dict['password_confirm'] ?>"
                                           name="passwordConfirm">
                                </div>
                            </div>
                            <input type="hidden" name="file" value="">
                            <div class="col-2">
                                <label><?= $this->dict['upload'] ?>
                                    <input type="file">
                                </label>
                            </div>
                            <div class="image"></div>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green"
                                    type="submit"><?= $this->dict['register'] ?></button>
                        </div>
                    </form>
                    <a href="/signin" class="bottom-link"><?= $this->dict['signin'] ?></a>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/assets/js/file-upload.js"></script>
<?php require_once 'footer.view.php'; ?>