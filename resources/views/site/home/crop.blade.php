<!DOCTYPE html>
<html>
<head>
  <title>Image Crop / Merge</title>
  <style>
    /* body {
  text-align: center;
} */

h1 {
  margin-top: 50px;
}

input {
  display: block;
  margin: 10px auto;
}

label {
  margin-right: 10px;
}

button {
  display: block;
  margin: 10px auto;
}

select {
  margin: 10px auto;
}

canvas {
  display: none;
}
.crop-toolbar {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }

    .crop-toolbar button {
      margin: 0 5px;
    }
   .main{
      width: 400px;
      text-align: center;
      margin: 0 auto;
   }
  .crop{
     width: 30%;
     text-align: center;
     margin: 0 auto;
  }
  .merge{
    margin: 0 auto;
    width: 60%;
    text-align: center;
  }
  .row{
    display: flex;
    width: 100%;
  }
  .row input{
    margin: 10px;
  }
  input, select , label{
        width: 100%;
        padding: 18px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        display: block;
        border-radius: 10px;
        font-size: 20px;
        margin: 10px;
      }
      @media screen and (max-width: 740px) {
        .merge{
          margin: 0 auto;
          width: 95%;
          text-align: center;
        }
        #canvas{
          max-width: 400px;
         max-height: 400px;
        }
        .row{
          display: block;
          width: 100%;
        }
     }
  </style>
   <link rel="stylesheet" href="./node_modules/cropperjs/dist/cropper.min.css">
   <link rel="stylesheet" href="./home/css/style.css" />
</head>
<body>
  @include('site.home.Header')
  <br>
  <div class="crop">
     <h1 class="title">Image Crop</h1>
    <div>
        {{-- <input type="file" id="imageInput" class="btn" accept="image/*"> --}}
        <input id="imageInput" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('imageInput').click();"
      />
      </div>
      <div >
        <img id="imagePreview" src="">
      </div>
      <div class="crop-toolbar">
        <button id="rotateLeftButton" class="btn">Rotate Left</button>
        <button id="rotateRightButton" class="btn">Rotate Right</button>
        <button id="downloadButton" class="btn">Download</button>
      </div>
 </div>
   <br> <br> <hr> <br> 

   <div class="merge">
    <h1 class="title">Image Merge</h1>
    <br> <br>
   <div class="row">
    {{-- <input type="file" id="image1" accept="image/*">
    <input type="file" id="image2" accept="image/*"> --}}
    <input id="image1" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('image1').click();"
      />
      <input id="image2" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('image2').click();"
      />
   </div>
    <br> <br>
     <div class="row">
      <label>
        <input type="radio" name="mergeType" value="horizontal" checked> Horizontal
      </label>
      <label>
        <input type="radio" name="mergeType" value="vertical"> Vertical
      </label>
     </div>
  <br> <br>
   <div class="row">
    <label>
      Image 1 Width:
      <input type="number" id="image1Width" placeholder="Width" min="1">
    </label>
    <label>
      Image 1 Height:
      <input type="number" id="image1Height" placeholder="Height" min="1">
    </label>
   </div>

      <br> <br>
    <div class="row">
      <label>
        Image 2 Width:
        <input type="number" id="image2Width" placeholder="Width" min="1">
      </label>
      <label>
        Image 2 Height:
        <input type="number" id="image2Height" placeholder="Height" min="1">
      </label>
    </div>

    <br> <br>
    <div class="row">
      <select id="formatSelect">
        <option value="jpg">JPG</option>
        <option value="png">PNG</option>
        <option value="gif">GIF</option>
      </select>
    </div>
    <br> <br>
    <div class="row">
      <button class="btn" onclick="mergeImages()">Merge</button>
    <button class="btn" onclick="downloadMerged()">Download</button>
    </div>
    <br> <br>
    <h3 class="title">Preview</h3>
  <br> <br>
    <canvas id="canvas"></canvas>
    <br> <br>
   </div>
   <div class="container">
    <h2>{{$setting->name}}</h2> <br>
    <p style="font-size: 17px;">{{$setting->description}}</p>
 </div>
 <br> <br> <br>
   @include('site.home.Footer')


   <script src="./home/js/app.js"></script>
 <script src="./node_modules/cropperjs/dist/cropper.min.js"></script>

  <script>
    // Function to merge images
   function mergeImages() {
  var image1 = document.getElementById("image1").files[0];
  var image2 = document.getElementById("image2").files[0];
  var mergeType = document.querySelector('input[name="mergeType"]:checked').value;
  var image1Width = parseInt(document.getElementById("image1Width").value);
  var image1Height = parseInt(document.getElementById("image1Height").value);
  var image2Width = parseInt(document.getElementById("image2Width").value);
  var image2Height = parseInt(document.getElementById("image2Height").value);

  // Check if both images are selected
  if (image1 && image2) {
    var img1 = new Image();
    var img2 = new Image();
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");

    // Load the first image
    img1.onload = function() {
      // Set canvas size based on merge type
      var canvasWidth, canvasHeight;
      if (mergeType === "horizontal") {
        canvasWidth = (image1Width || img1.width) + (image2Width || img2.width);
        canvasHeight = Math.max(image1Height || img1.height, image2Height || img2.height);
      } else {
        canvasWidth = Math.max(image1Width || img1.width, image2Width || img2.width);
        canvasHeight = (image1Height || img1.height) + (image2Height || img2.height);
      }
      canvas.width = canvasWidth;
      canvas.height = canvasHeight;

      // Draw the first image on the canvas
      ctx.drawImage(img1, 0, 0, image1Width || img1.width, image1Height || img1.height);

      // Load the second image
      img2.onload = function() {
        // Merge images based on merge type
        if (mergeType === "horizontal") {
          ctx.drawImage(img2, (image1Width || img1.width), 0, image2Width || img2.width, image2Height || img2.height);
        } else {
          ctx.drawImage(img2, 0, (image1Height || img1.height), image2Width || img2.width, image2Height || img2.height);
        }

        // Show the canvas
        canvas.style.display = "block";
      };

      img2.src = URL.createObjectURL(image2);
    };

    img1.src = URL.createObjectURL(image1);
  } else {
    alert("Please select two images.");
  }
}

// Function to download the merged image
function downloadMerged() {
  var formatSelect = document.getElementById("formatSelect");
  var format = formatSelect.options[formatSelect.selectedIndex].value;
  var canvas = document.getElementById("canvas");
  var downloadLink = document.createElement("a");
  downloadLink.style.display = "none";

  if (format === "pdf") {
    // Convert canvas to PDF and download
    var pdf = new jsPDF();
    pdf.addImage(canvas.toDataURL("image/jpeg"), "JPEG", 0, 0);
    pdf.save("merged_image.pdf");
  } else {
    // Convert canvas to the selected format and download
    downloadLink.href = canvas.toDataURL("image/" + format);
    downloadLink.download = "merged_image." + format;
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
  }
}
  </script>
 


   <script>
 
 
 document.addEventListener('DOMContentLoaded', function() {
   var imageInput = document.getElementById('imageInput');
   var imagePreview = document.getElementById('imagePreview');
   var rotateLeftButton = document.getElementById('rotateLeftButton');
   var rotateRightButton = document.getElementById('rotateRightButton');
 
   var downloadButton = document.getElementById('downloadButton');
 
   var cropper;
 
   imageInput.addEventListener('change', function(e) {
     var file = e.target.files[0];
     var reader = new FileReader();
 
     reader.onload = function(e) {
       imagePreview.src = e.target.result;
       if (cropper) {
         cropper.destroy();
       }
       cropper = new Cropper(imagePreview, {
         aspectRatio: 1,
         viewMode: 2,
         autoCropArea: 1,
         responsive: true,
         guides: true,
         center: true,
         highlight: true,
         dragMode: 'move',
         cropBoxResizable: true,
         cropBoxMovable: true
       });
     };
 
     reader.readAsDataURL(file);
   });
 
   rotateLeftButton.addEventListener('click', function() {
     cropper.rotate(-90);
   });
 
   rotateRightButton.addEventListener('click', function() {
     cropper.rotate(90);
   });
 
 
 
   downloadButton.addEventListener('click', function() {
     var croppedCanvas = cropper.getCroppedCanvas();
     croppedCanvas.toBlob(function(blob) {
       var url = URL.createObjectURL(blob);
       var a = document.createElement('a');
       a.href = url;
       a.download = 'cropped_image.png';
       a.click();
     });
   });
 });
 
   </script>
</body>
</html>
