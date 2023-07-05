<!DOCTYPE html>
<html>
<head>
  <title>Image Converter</title>
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
/>
<link
  rel="stylesheet"
  href="https://unpkg.com/swiper/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="./home/css/style.css" />
<style>
   .form-group{
        display: flex;
        width: 70%;
      }

      @media screen and (max-width: 740px) {
        .form-group{
          display: block;
          width: 100%;
          /* flex-direction: column-reverse; */
        }
        .form-group label{
          line-height: 30px; 
        }
     }

      input, select{
        width: 80%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        display: block;
        font-size: 20px;
      }
      button{
        cursor: pointer;
      }
      label{
        display: block;
        width: 170px;
        line-height: 70px;
      }
</style>
</head>
<body>
    @include('site.home.Header')
    <br> <br>
   <br>
  <div class="container">
    <h1 class="title">Image Converter</h1>
    <br> <br>
    <div class="form-group">
      <label for="imageInput">Select Image:</label>
      {{-- <input type="file" id="imageInput" class="form-control"> --}}
      <input id="imageInput" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('imageInput').click();"
      />
    </div>
    <div class="form-group">
      <label for="exportAs">Export As:</label>
      <select id="exportAs" class="form-control">
        <option value="jpg">JPG</option>
        <option value="png">PNG</option>
        <option value="gif">GIF</option>
        <option value="webp">WEBP</option>
        <option value="heic">HEIC</option>
        <option value="ico">ICO</option>
        <option value="bmp">BMP</option>
        <option value="tiff">TIFF</option>
      </select>
    </div>
    <div class="form-group">
      <label for="backgroundType">Background:</label>
      <select id="backgroundType" class="form-control">
        <option value="transparent">Transparent</option>
        <option value="color">Color</option>
      </select>
    </div>
    <div id="colorPickerContainer" class="form-group" style="display: none;">
      <label for="colorPicker">Color:</label>
      <input type="color" id="colorPicker" style="padding: 10px 0;" class="form-control">
    </div>
    <div class="form-group">
      <label for="fileName">File Name:</label>
      <input type="text" id="fileName" class="form-control">
    </div>
    <br> 
    <button id="convertButton" class="btn btn-primary">Convert Image</button>
    <div id="downloadLinkContainer" style="display: none;">
      <br>
      <a id="downloadLink" class="btn btn-success" href="#" download>Download Converted Image</a>
    </div>
  </div>
  <br> <br> <br>
  <div class="container">
    <h2>{{$setting->name}}</h2> <br>
    <p style="font-size: 17px;">{{$setting->description}}</p>
 </div>
 <br> <br> <br>
  @include('site.home.Footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./home/js/isotope.pkgd.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="./home/js/app.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
  var convertedImage = null;

  var imageInput = document.getElementById("imageInput");
  var exportAs = document.getElementById("exportAs");
  var backgroundType = document.getElementById("backgroundType");
  var colorPickerContainer = document.getElementById("colorPickerContainer");
  var colorPicker = document.getElementById("colorPicker");
  var fileName = document.getElementById("fileName");
  var convertButton = document.getElementById("convertButton");
  var downloadLinkContainer = document.getElementById("downloadLinkContainer");
  var downloadLink = document.getElementById("downloadLink");

  backgroundType.addEventListener("change", function() {
    if (backgroundType.value === "color") {
      colorPickerContainer.style.display = "block";
    } else {
      colorPickerContainer.style.display = "none";
    }
  });

  convertButton.addEventListener("click", function() {
    var image = document.createElement("img");
    var exportType = exportAs.value;
    var background = backgroundType.value;
    var color = colorPicker.value;
    var fileNameValue = fileName.value;

    image.onload = function() {
      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");

      canvas.width = image.width;
      canvas.height = image.height;

      if (background === "color") {
        ctx.fillStyle = color;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
      }

      ctx.drawImage(image, 0, 0);

      var convertedData = canvas.toDataURL("image/" + exportType);
      convertedImage = convertedData.replace("image/" + exportType, "image/octet-stream");
      
      downloadLink.href = convertedImage;
      downloadLink.download = (fileNameValue || "converted-image") + "." + exportType;

      downloadLinkContainer.style.display = "block";
    }

    image.src = URL.createObjectURL(imageInput.files[0]);
  });
});

  </script>
</body>
</html>
