function previewImage(input) {
  const images = document.getElementById("images");
  if (images !== null) {
    images.style.display = "none";
  }
  var preview = document.getElementById("image-preview");

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      preview.innerHTML =
        '<img src="' +
        e.target.result +
        '" alt="Image Preview" style="width:200px;">';
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    preview.innerHTML = "";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var thElements = document
    .getElementById("data-table")
    .getElementsByTagName("td");
  var colWidths = Array.from(thElements).map(
    (th) => th.getBoundingClientRect().width
  );

  var trElements = document
    .getElementById("data-table")
    .getElementsByTagName("thead");
  for (var i = 0; i < trElements.length; i++) {
    var tdElements = trElements[i].getElementsByTagName("th");
    for (var j = 0; j < tdElements.length; j++) {
      (j == 5) ? tdElements[j].style.width = (colWidths[j] + 17) + "px" : tdElements[j].style.width = colWidths[j] + "px";
    }
  }
});
