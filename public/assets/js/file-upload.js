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
        if (response.data.success) {
            let imagePath = response.data.imageName;
            document.querySelector('div.image').innerHTML = '<div class="uploaded-image">' +
                '<img src="' + imagePath + '">' +
                '</div>';
            document.querySelector('input[name="file"]').value = imagePath;
        } else {
            document.querySelector('div.image').innerHTML = `<div class="flash">${response.data.error}</div>`;
        }
    });
});