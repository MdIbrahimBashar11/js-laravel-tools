<!DOCTYPE html>
<html>
<head>
  <title>Image Vibrance Adjustment</title>
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
     .vibran{
        max-width: 600px;
        margin: 0 auto;
      }
      @media screen and (max-width: 790px) {
        .imgs{
          display: block;
        }
        .vibran{
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
 <div class="vibran">
    <h1 class="title">Image Vibrance Adjustment</h1>
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
    <label for="vibranceRange">Vibrance: <span id="vibranceValue">0</span></label>
    <input type="range" id="vibranceRange" min="-100" max="100" value="0">
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
  const vibranceRange = document.getElementById('vibranceRange');
  const vibranceValue = document.getElementById('vibranceValue');
  const previewImage = document.getElementById('preview');
  const downloadBtn = document.getElementById('downloadBtn');
  
  let camanInstance = null;

  // Update vibrance value display
  vibranceRange.addEventListener('input', function() {
    vibranceValue.textContent = vibranceRange.value;
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
          this.vibrance(vibranceRange.value);
          this.render();
          downloadBtn.disabled = false;
        });
      };
      reader.readAsDataURL(file);
    }
  });

  // Apply vibrance adjustment to the image
  function processImage() {
    if (camanInstance) {
      camanInstance.revert(false);
      camanInstance.vibrance(vibranceRange.value);
      camanInstance.render();
    }
  }

  // Download the modified image
  downloadBtn.addEventListener('click', function() {
    if (camanInstance) {
      camanInstance.save("vibrance_adjusted_image.png");
    }
  });
});

  </script>
</body>
</html>
