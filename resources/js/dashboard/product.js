// resources/js/dashboard/product.js

document.addEventListener('DOMContentLoaded', function () {
  const imageInput = document.getElementById('productImageInput');
  const preview = document.getElementById('imagePreview');

  if (imageInput) {
    imageInput.addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
      } else {
        preview.src = "https://via.placeholder.com/120";
      }
    });
  }
});
