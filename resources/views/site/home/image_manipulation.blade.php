<!DOCTYPE html>
<html>
<head>
  <title>Image Resizer</title>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
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
      .row{
        display: flex;
        width: 100%;
        margin: 0 10px;
      }
      .col-md-6{
          width: 50%;
      }
      @media screen and (max-width: 740px) {
        .row{
          /* display: block; */
          width: 100%;
          flex-direction: column-reverse;
        }
        .col-md-6{
          width: 100%;
        }
     }
      .col-md-6 .two-form{
          display: flex;
      }
      .form-group{
          margin: 10px 10px;
      }
      .col-md-6 input, select{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }
      button{
        cursor: pointer;
      }
      img{
          max-height: 80vh ;
          width: 70% ;
      }
</style>
</head>
<body>

    @include('site.home.Header')
    <br>
    <br>
    <br>
  <div class="container">
    <h1 class="title">IMAGE RESIZE</h1>
    <br> <br>
    <div class="row">
        <div class="col-md-6">
            <h3>Modified Image</h3>
            <div id="modifiedImageContainer">
              <img id="modifiedImage" src="" alt="Modified Image" class="img-responsive">
            </div>

            <br>
            <br>
      
            <h4>Resize Image</h4>
            <div class="two-form">
              <div class="form-group">
                <label for="resizeWidth">Width: (PX)</label>
                <input type="number" id="resizeWidth" class="form-control">
              </div>
              <div class="form-group">
                <label for="resizeHeight">Height: (PX)</label>
                <input type="number" id="resizeHeight" class="form-control">
              </div>
            </div> 
               
            <button id="resizeButton" class="btn btn-primary">Resize Image</button>
            <br>
            <br>
            <h4>Save Image</h4>
            <div class="two-form">
              <div class="form-group">
                <label for="imageFormat">Image Format:</label>
                <select id="imageFormat" class="form-control">
                  <option value="jpeg">JPEG</option>
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
                <label for="imageName">Image Name:</label>
                <input type="text" id="imageName" class="form-control">
              </div>
            </div>
          
            <button id="saveButton" class="btn btn-success">Save Image</button>
            <br>
            <br>
          </div>
      <div class="col-md-6">
        <h3>Original Image</h3>
        <br>
        {{-- <input class="btn btn-primary" type="file" id="imageInput"> --}}
        <input id="imageInput" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('imageInput').click();"
      />
        <div id="previewContainer">
          <img id="previewImage" src="" alt="Preview" class="img-responsive">
        </div>
      </div>
     
    </div>
  </div>
  <br>
  <br>
  <div class="container">
     <h2>{{$setting->name}}</h2> <br>
     <p style="font-size: 17px;">{{$setting->description}}</p>
  </div>
  <br> <br> <br>
  @include('site.home.Footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./home/js/isotope.pkgd.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="./home/js/app.js"></script>
  <script>

$(document).ready(function() {
  var originalImage = null;

  var modifiedImage = null;

  // Select image and display preview
  $("#imageInput").change(function(e) {
    var file = e.target.files[0];
    originalImage = URL.createObjectURL(file);
    $("#previewImage").attr("src", originalImage);
    $("#modifiedImage").attr("src", "");
    $("#modifiedImageContainer").hide();
  });

  // Crop image
  $("#cropButton").click(function() {
    if (originalImage) {
      var width = parseInt($("#cropWidth").val());
      var height = parseInt($("#cropHeight").val());
      var top = parseInt($("#cropTop").val());
      var bottom = parseInt($("#cropBottom").val());

      // Create a temporary canvas element
      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");

      // Set the canvas dimensions
      canvas.width = width;
      canvas.height = height;

      // Create a new image element
      var image = new Image();
      image.src = originalImage;

      // Draw the cropped portion of the image on the canvas
      // ctx.drawImage(image, 0, top, width, height, 0, 0, width, height);
      ctx.drawImage(image, 0, 0, width, height);

      // Get the data URL of the modified image
      modifiedImage = canvas.toDataURL();

      // Display the modified image
      $("#modifiedImage").attr("src", modifiedImage);
      $("#modifiedImageContainer").show();
    }
  });


   // Rotate/Flip image
   $("#rotateButton").click(function() {
    if (originalImage) {
      var degrees = parseInt($("#rotationDegrees").val());

      // Create a temporary canvas element
      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");

      // Create a new image element
      var image = new Image();
      image.src = originalImage;

      // Set the canvas dimensions based on rotation/flipping
      if (degrees === 90 || degrees === 270) {
        canvas.width = image.height;
        canvas.height = image.width;
      } else {
        canvas.width = image.width;
        canvas.height = image.height;
      }

      // Perform rotation/flipping logic
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.save();
      ctx.translate(canvas.width / 2, canvas.height / 2);
      ctx.rotate((Math.PI / 180) * degrees);
      ctx.drawImage(image, -image.width / 2, -image.height / 2);
      ctx.restore();

      // Get the data URL of the modified image
      modifiedImage = canvas.toDataURL();

      // Display the modified image
      $("#modifiedImage").attr("src", modifiedImage);
      $("#modifiedImageContainer").show();
    }
  });

  // Resize image
  $("#resizeButton").click(function() {
    if (originalImage) {
      var width = parseInt($("#resizeWidth").val());
      var height = parseInt($("#resizeHeight").val());

      // Create a temporary canvas element
      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");

      // Set the canvas dimensions
      canvas.width = width;
      canvas.height = height;

      // Create a new image element
      var image = new Image();
      image.src = originalImage;

      // Draw the resized portion of the image on the canvas
      // ctx.drawImage(image, 0, top, width, height, 0, 0, width, height);
      ctx.drawImage(image, 0, 0, width, height);

      // Get the data URL of the modified image
      modifiedImage = canvas.toDataURL();

      // Display the modified image
      $("#modifiedImage").attr("src", modifiedImage);
      $("#modifiedImageContainer").show();
    }
  });

  // Save image
  $("#saveButton").click(function() {
    if (modifiedImage) {
      var format = $("#imageFormat").val();
      var name = $("#imageName").val();

      // Save modified image
      saveImage(modifiedImage, format, name);
    }
  });

  function saveImage(imageData, format, name) {
    // Create a temporary anchor element to trigger the download
    var link = document.createElement("a");
    link.href = imageData;
    link.download = name + "." + format;
    link.click();
  }
});


  </script>
</body>
</html>
