<!DOCTYPE html>
<html>
<head>
  <title>Image Rotate</title>
  <style>

img {
  max-width: 400px;
  margin-top: 20px;
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
      .rotet , .filp{
        max-width: 600px;
        margin: 0 auto;
        
      }
      .imgs{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        margin: 0 auto;
      }
      @media screen and (max-width: 790px) {
        .imgs{
          display: block;
        }
        .rotet , .filp{
        width: 100%;
        margin: 0 20px;
        
      }
     }
  </style>
  <link rel="stylesheet" href="./home/css/style.css" />
</head>
<body>
    @include('site.home.Header')
    <br>
    <br> <br>
  <div class="rotet">
    <h1 class="title">Image Rotate</h1>
    <br><br>
  {{-- <input type="file" id="inputFile" accept="image/*"> --}}
  <input id="imageInput" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('imageInput').click();"
      />
  <div>
    <button class="btn" id="rotate90Btn">Rotate 90°</button>
    <button class="btn" id="rotate180Btn">Rotate 180°</button>
    <button class="btn" id="rotate270Btn">Rotate 270°</button>
  </div>
  <div>
    <label>
      Select File Type:
      <select id="fileType" >
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
    </label>
  </div>
  <a href="#" class="btn" id="downloadBtn" download>Download</a>
  <br>
  </div>
  </div>
  <div class="imgs">
    <img  id="previewImage" src="#" alt="Selected Image">
  <img id="rotatedImage" src="#" alt="Rotated Image">
  </div>
      <br> <br> <br>
   <div class="container">
    <h2>{{$setting->name}}</h2> <br> 
    <p style="font-size: 17px;">{{$setting->description}}</p>
 </div>
<br> <br> <br>
@include('site.home.Footer')

<script src="./home/js/app.js"></script>
  <script>
        // File input
        const inputFile = document.getElementById('inputFile');
        // Image preview
        const previewImage = document.getElementById('previewImage');
        // Rotated image
        const rotatedImage = document.getElementById('rotatedImage');
        // Rotate buttons
        const rotate90Btn = document.getElementById('rotate90Btn');
        const rotate180Btn = document.getElementById('rotate180Btn');
        const rotate270Btn = document.getElementById('rotate270Btn');
        // File type select input
        const fileTypeSelect = document.getElementById('fileType');
        // Download button
        const downloadBtn = document.getElementById('downloadBtn');

        let image;

        // File input change event
        inputFile.addEventListener('change', function(event) {
        const file = event.target.files[0];

        // Create FileReader object to read the image
        const reader = new FileReader();
        reader.onload = function(e) {
            image = new Image();
            image.src = e.target.result;
            image.onload = function() {
            // Display the selected image
            previewImage.src = image.src;

            // Show the download button
            downloadBtn.style.display = 'inline-block';
            };
        };
        reader.readAsDataURL(file);
        });

        // Rotate buttons click events
        rotate90Btn.addEventListener('click', function() {
        rotateImage(90);
        });

        rotate180Btn.addEventListener('click', function() {
        rotateImage(180);
        });

        rotate270Btn.addEventListener('click', function() {
        rotateImage(270);
        });

        // Rotate image function
        function rotateImage(angle) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        const width = image.naturalWidth;
        const height = image.naturalHeight;

        canvas.width = height;
        canvas.height = width;
        ctx.translate(height / 2, width / 2);
        ctx.rotate((angle * Math.PI) / 180);
        ctx.drawImage(image, -width / 2, -height / 2, width, height);

        rotatedImage.src = canvas.toDataURL(`image/${fileTypeSelect.value}`);
        }

        // Download button click event
        downloadBtn.addEventListener('click', function() {
        const downloadLink = document.createElement('a');
        const downloadImage = fileTypeSelect.value === 'jpg' ? rotatedImage : previewImage;
        downloadLink.href = downloadImage.src;
        downloadLink.download = `transformed_image.${fileTypeSelect.value}`;
        downloadLink.click();
        });

  </script>
    <script>
      // File input
      const inputFile = document.getElementById('inputFile');
      // Image preview
      const previewImage = document.getElementById('previewImage');
      // Flipped image
      const flippedImage = document.getElementById('flippedImage');
      // Flip buttons
      const flipHorizontalBtn = document.getElementById('flipHorizontalBtn');
      const flipVerticalBtn = document.getElementById('flipVerticalBtn');
      // File type select input
      const fileTypeSelect = document.getElementById('fileType');
      // Download button
      const downloadBtn = document.getElementById('downloadBtn');
      
      let image;
      
      // File input change event
      inputFile.addEventListener('change', function(event) {
        const file = event.target.files[0];
      
        // Create FileReader object to read the image
        const reader = new FileReader();
        reader.onload = function(e) {
          image = new Image();
          image.src = e.target.result;
          image.onload = function() {
            // Display the selected image
            previewImage.src = image.src;
      
            // Show the download button
            downloadBtn.style.display = 'inline-block';
          };
        };
        reader.readAsDataURL(file);
      });
      
      // Flip buttons click events
      flipHorizontalBtn.addEventListener('click', function() {
        flipImage('horizontal');
      });
      
      flipVerticalBtn.addEventListener('click', function() {
        flipImage('vertical');
      });
      
      // Flip image function
      function flipImage(axis) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
      
        const width = image.naturalWidth;
        const height = image.naturalHeight;
      
        canvas.width = width;
        canvas.height = height;
      
        if (axis === 'horizontal') {
          ctx.translate(width, 0);
          ctx.scale(-1, 1);
        } else if (axis === 'vertical') {
          ctx.translate(0, height);
          ctx.scale(1, -1);
        }
      
        ctx.drawImage(image, 0, 0, width, height);
      
        flippedImage.src = canvas.toDataURL(`image/${fileTypeSelect.value}`);
      }
      
      // Download button click event
      downloadBtn.addEventListener('click', function() {
        const downloadLink = document.createElement('a');
        downloadLink.href = flippedImage.src;
        downloadLink.download = `transformed_image.${fileTypeSelect.value}`;
        downloadLink.click();
      });
      
      
        </script>
</body>
</html>
