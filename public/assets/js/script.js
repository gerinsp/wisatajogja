function previewImage(input) {
    const images = document.getElementById('images')
    if (images !== null) {
        images.style.display = 'none'
    }
    var preview = document.getElementById('image-preview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview" style="width:200px;">';
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.innerHTML = '';
    }
}