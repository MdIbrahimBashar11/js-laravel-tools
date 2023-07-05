<!DOCTYPE html>
<html>
<head>
  <title>Invert Colors</title>
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
     .invert{
        max-width: 600px;
        margin: 0 auto;
      }
      @media screen and (max-width: 790px) {
        .imgs{
          display: block;
        }
        .invert{
          max-width: 100%;
        padding: 0 10px;
          margin: 0 auto;
      }
     }

  </style>
      <link rel="stylesheet" href="./home/css/style.css" />
</head>
<body>
    @include('site.home.Header')
    <br>
   <br> <br>
 <div class="invert">
    <h1 class="title">Invert Colors</h1>
  <br>
    {{-- <input type="file" id="imageInput" accept="image/*" /> --}}
    <input id="imageInput" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('imageInput').click();"
      />
     <br>
    <div id="previewContainer">
      <h2>Preview:</h2>
      <img id="previewImage" src="" alt="Preview Image" />
    </div>
     <br>
    <button class="btn" id="invertButton" disabled>Invert Colors</button>
    <button class="btn"  id="downloadButton" disabled>Download</button>
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
    // Get elements
const imageInput = document.getElementById('imageInput');
const previewImage = document.getElementById('previewImage');
const invertButton = document.getElementById('invertButton');
const downloadButton = document.getElementById('downloadButton');

// Add event listeners
imageInput.addEventListener('change', handleImageInput);
invertButton.addEventListener('click', invertColors);
downloadButton.addEventListener('click', downloadImage);

// Image input handler
function handleImageInput(event) {
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = function(e) {
    previewImage.src = e.target.result;
    invertButton.disabled = false;
  };

  reader.readAsDataURL(file);
}

// Invert colors of the image
function invertColors() {
  const canvas = document.createElement('canvas');
  const context = canvas.getContext('2d');
  
  const img = new Image();
  img.onload = function() {
    canvas.width = img.width;
    canvas.height = img.height;
    
    context.drawImage(img, 0, 0);
    
    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
    const data = imageData.data;
    
    for (let i = 0; i < data.length; i += 4) {
      data[i] = 255 - data[i];       // red
      data[i + 1] = 255 - data[i + 1]; // green
      data[i + 2] = 255 - data[i + 2]; // blue
    }
    
    context.putImageData(imageData, 0, 0);
    
    previewImage.src = canvas.toDataURL();
    downloadButton.disabled = false;
  };
  
  img.src = previewImage.src;
}

// Download the image
function downloadImage() {
  const link = document.createElement('a');
  link.href = previewImage.src;
  link.download = 'inverted_image.png';
  link.click();
}

  </script>
</body>
</html>
