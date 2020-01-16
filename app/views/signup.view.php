<?php require_once 'header.view.php'; ?>

<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title"><?=$title?></h2>
                <?=components\FlashMessages::show();?>
                <form method="POST" action="/create" id="signup">
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="EMAIL" name="email">
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-1" type="text" placeholder="PASSWORD" name="password">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-1" type="text" placeholder="PASSWORD CONFIRM"
                                       name="passwordConfirm">
                            </div>
                        </div>
                        <input type="hidden" name="file" value="">
                        <div class="col-2">
                            <label> Enter Your File
                                <input type="file" form="upload-form">
                            </label>
                        </div>
                        <div class="image"></div>
                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--green" type="submit">Submit</button>
                    </div>
                </form>
                <form method="post" action="#" enctype="multipart/form-data" id="upload-form">
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let fileInput = document.querySelector('input[type="file"]');

    fileInput.addEventListener("change", (e) => {
        let formData = new FormData();
        let file = e.target.files[0];

        formData.append('file', file);

        axios.post('/upload-image',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        ).then(response => {
            let imagePath = response.data.imageName;
            document.querySelector('div.image').innerHTML = '<div class="uploaded-image">' +
                '<img src="' + imagePath + '">' +
                '</div>';
            document.querySelector('input[name="file"]').value = imagePath;
        });
    });
</script>
<?php require_once 'footer.view.php'; ?>