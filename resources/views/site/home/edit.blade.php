<!DOCTYPE html>
<html>
<head>
  <title>Image Editor</title>
  <style>
    #image-preview {
      max-width: 500px;
      max-height: 500px;
    }

    .edit{
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
        width: 300px;
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
        .edit{
          margin: 0 auto;
          width: 95%;
          text-align: center;
        }
        #image-preview{
          max-width: 400px;
         max-height: 400px;
        }
        .row{
          display: block;
          width: 100%;
        }
        input, select , label{
          width: 100%;
        }
      }
      .title{
        text-align: center;
      }
  </style>
  <link rel="stylesheet" href="./home/css/style.css" />
</head>
<body>
  @include('site.home.Header')
  <br> <br>
 
    <div class="edit">
      <h1 class="title">Image Editor</h1>
      <br> <br> <br>
      <div class="row">
        <input  class="btn" style="display: none" type="file" id="image-input" accept="image/jpeg, image/png" onchange="loadImage(event)">
        {{-- <input id="imageInput" type="file" style="display: none" name="image"  required /> --}}
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('image-input').click();"
      />
       </div>
      <div class="row">
        <div>
          <label for="darken-range">Darken:</label>
          <input type="range" id="darken-range" min="0" max="100" value="0" step="1" onchange="applyFilters()">
        </div>
        <div>
          <label for="lighten-range">Lighten:</label>
          <input type="range" id="lighten-range" min="0" max="100" value="0" step="1" onchange="applyFilters()">
        </div>
      </div>
       <div class="row">
        <div>
          <label for="brightness-range">Brightness:</label>
          <input type="range" id="brightness-range" min="0" max="200" value="100" step="1" onchange="applyFilters()">
        </div>
        <div>
          <label for="blur-range">Blur:</label>
          <input type="range" id="blur-range" min="0" max="10" value="0" step="0.1" onchange="applyFilters()">
        </div>
       </div>
        <div class="row">
          <div>
            <label for="file-type">File Type:</label>
            <select id="file-type" onchange="setFileType()">
              <option value="jpeg">JPEG</option>
              <option value="png">PNG</option>
              <option value="jpg">JPG</option>
              <option value="gif">GIF</option>
              <option value="webp">WEBP</option>
            </select>
          </div>
          <div>
            <label for="image-name">Image Name:</label>
            <input type="text" id="image-name" placeholder="Image Name." onchange="setImageName()">
          </div>
        </div>
      
      <div>
          <div class="row">
            <button class="btn" onclick="resetFilters()">Reset Filters</button>
        <button class="btn" onclick="downloadImage()">Download Image</button>
          </div>
      </div>
      <br> <br>
      <div class="row">
        <img id="image-preview">
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
  <script src="./home/js/app.js"></script>
  <script>
    let originalImage;
let modifiedImage;
let fileType = 'jpeg';
let imageName = 'modified_image';

function loadImage(event) {
  const input = event.target;
  const reader = new FileReader();

  reader.onload = function() {
    originalImage = new Image();
    originalImage.src = reader.result;
    originalImage.onload = function() {
      // Display the original image
      const imagePreview = document.getElementById('image-preview');
      imagePreview.src = originalImage.src;
      // Apply initial filters
      applyFilters();
    };
  };

  const file = input.files[0];
  reader.readAsDataURL(file);
}

function applyFilters() {
  const darkenValue = document.getElementById('darken-range').value;
  const lightenValue = document.getElementById('lighten-range').value;
  const brightnessValue = document.getElementById('brightness-range').value;
  const blurValue = document.getElementById('blur-range').value;

  // Create a canvas to draw the modified image
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');

  // Adjust the canvas size to match the image size
  canvas.width = originalImage.width;
  canvas.height = originalImage.height;

  // Apply filters to the image
  ctx.filter = `brightness(${brightnessValue}%)`;
  ctx.drawImage(originalImage, 0, 0);
  ctx.filter = `blur(${blurValue}px)`;
  ctx.drawImage(canvas, 0, 0);
  ctx.filter = `brightness(${lightenValue}%)`;
  ctx.drawImage(canvas, 0, 0);
  ctx.filter = `brightness(${1 - darkenValue / 100})`;
  ctx.drawImage(canvas, 0, 0);

  // Store the modified image
  modifiedImage = new Image();
  modifiedImage.src = canvas.toDataURL(`image/${fileType}`);
  // Display the modified image
  const imagePreview = document.getElementById('image-preview');
  imagePreview.src = modifiedImage.src;
}

function resetFilters() {
  // Reset the range inputs
  document.getElementById('darken-range').value = 0;
  document.getElementById('lighten-range').value = 0;
  document.getElementById('brightness-range').value = 100;
  document.getElementById('blur-range').value = 0;

  // Reapply filters
  applyFilters();
}

function setFileType() {
  fileType = document.getElementById('file-type').value;
  applyFilters();
}

function setImageName() {
  imageName = document.getElementById('image-name').value;
}

function downloadImage() {
  // Create a temporary link to download the modified image
  const link = document.createElement('a');
  link.href = modifiedImage.src;
  link.download = `${imageName}.${fileType}`;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

  </script>
</body>
</html>
