<!DOCTYPE html>
<html>
<head>
  <title>Image Gamma Adjustment</title>
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
     .gamma{
        max-width: 600px;
        margin: 0 auto;
      }
      @media screen and (max-width: 790px) {
        .imgs{
          display: block;
        }
        .gamma{
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
 <div class="gamma">
    <h1 class="title">Image Gamma Adjustment</h1>
     <br>
    {{-- <input type="file" id="imageInput" accept="image/*"> --}}
    <input id="imageInput" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('imageInput').click();"
      />
    <br>
    <label for="gammaRange">Gamma: <span id="gammaValue">1</span></label>
    <input type="range" id="gammaRange" min="0.1" max="5" step="0.1" value="1">
    <br>
    <img id="preview" src="#" alt="Image Preview">
    <br>
    <button class="btn" id="downloadBtn" disabled>Download</button>
 </div>
  <br> <br> <br>
  <div class="container">
   <h2>{{$setting->name}}</h2> <br> 
   <p style="font-size: 17px;">{{$setting->description}}</p>
</div>
<br> <br> <br>
@include('site.home.Footer')
<script src="./home/js/app.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/camanjs/4.1.2/caman.full.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
  const imageInput = document.getElementById('imageInput');
  const gammaRange = document.getElementById('gammaRange');
  const gammaValue = document.getElementById('gammaValue');
  const previewImage = document.getElementById('preview');
  const downloadBtn = document.getElementById('downloadBtn');
  
  let camanInstance = null;

  // Update gamma value display
  gammaRange.addEventListener('input', function() {
    gammaValue.textContent = gammaRange.value;
    processImage();
  });

  // Load selected image and process it with CamanJS
  imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      if (camanInstance) {
        camanInstance.reset();
        camanInstance = null;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        previewImage.src = e.target.result;
        camanInstance = Caman(previewImage, function() {
          this.revert(false);
          this.gamma(gammaRange.value);
          this.render();
          downloadBtn.disabled = false;
        });
      };
      reader.readAsDataURL(file);
    }
  });

  // Apply gamma adjustment to the image
  function processImage() {
    if (camanInstance) {
      camanInstance.revert(false);
      camanInstance.gamma(gammaRange.value);
      camanInstance.render();
    }
  }

  // Download the modified image
  downloadBtn.addEventListener('click', function() {
    if (camanInstance) {
      camanInstance.save("gamma_adjusted_image.png");
    }
  });
});

  </script>
</body>
</html>
