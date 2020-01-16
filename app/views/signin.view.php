<?php require_once 'header.view.php'; ?>

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Sign In</h2>
                <?=components\FlashMessages::show();?>
                <form method="POST" action="/auth">
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="EMAIL" name="email">
                    </div>
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="PASSWORD" name="password">
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--green" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.view.php'; ?>