<!DOCTYPE html>
<html>
<head>
  <title>Image Compressor</title>
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
    
    .form-group{
        display: flex;
        width: 70%;
      }

      @media screen and (max-width: 740px) {
        .form-group{
          display: block;
          width: 90%;
          /* flex-direction: column-reverse; */
        }
        .form-group label{
          line-height: 30px; 
        }
        .main{
          width: 100%;
          margin: 0 20px;
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
      .main{
        max-width: 600px;
        margin: 0 auto;
      }
    
   </style>
</head>
<body>
  @include('site.home.Header')
   <br>
   <br> <br>
    <div class="main">
      <h1 class="title">Image Compressor</h1>
      <input id="inputFile" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('inputFile').click();"
      />
      <br> <br>
      <p>Selected Image Size: <span id="selectedSize"></span></p> <br>
      <p>After Compress Image Size: <span id="compressedSize"></span></p>
      <input type="range" id="compressLevel" min="0" max="100" value="50">
      <label>
        Select File Type:
        <select id="fileType">
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
      <button  class="btn" id="compressBtn">Compress</button>
      <a class="btn" href="#" id="downloadBtn" download>Download</a>
      <br>
      <img id="previewImage" src="#" alt="Selected Image">
      <img id="compressedImage" src="#" alt="Compressed Image">
      <br> <br> <br>
     
    </div>
    <div class="container">
      <h2>{{$setting->name}}</h2> <br>
      <p style="font-size: 17px;">{{$setting->description}}</p>
   </div>
 <br> <br> <br>
  @include('site.home.Footer')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./home/js/isotope.pkgd.min.js"></script>
    <script src="./home/js/app.js"></script>

    <script>
      // File input
  const inputFile = document.getElementById('inputFile');
  // Image size displays
  const selectedSizeDisplay = document.getElementById('selectedSize');
  const compressedSizeDisplay = document.getElementById('compressedSize');
  // Compress level range input
  const compressLevel = document.getElementById('compressLevel');
  // File type select input
  const fileTypeSelect = document.getElementById('fileType');
  // Compress button
  const compressBtn = document.getElementById('compressBtn');
  // Download button
  const downloadBtn = document.getElementById('downloadBtn');
  // Preview image display
  const previewImage = document.getElementById('previewImage');
  // Compressed image display
  const compressedImage = document.getElementById('compressedImage');
  
  // Minimum and maximum file size limits in bytes
  const minFileSize = 20000; // 20 KB
  const maxFileSize = 5000000; // 5 MB
  
  // File input change event
  inputFile.addEventListener('change', function(event) {
    const file = event.target.files[0];
  
    // Check file size
    if (file.size < minFileSize || file.size > maxFileSize) {
      alert('Please select an image between 20 KB and 5 MB.');
      return;
    }
  
    // Update selected image size display
    selectedSizeDisplay.textContent = (file.size / 1024).toFixed(2) + ' KB';
  
    // Create FileReader object to read the image
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = new Image();
      img.src = e.target.result;
      img.onload = function() {
        // Display the selected image
        previewImage.src = img.src;
  
        // Update compressed image size display with the original image size
        compressedSizeDisplay.textContent = (img.src.length / 1024).toFixed(2) + ' KB';
      };
    };
    reader.readAsDataURL(file);
  });
  
  // Compress button click event
  compressBtn.addEventListener('click', function() {
    const compressValue = compressLevel.value;
    const image = previewImage;
    const fileType = fileTypeSelect.value;
  
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
  
    const width = image.naturalWidth;
    const height = image.naturalHeight;
  
    canvas.width = width;
    canvas.height = height;
  
    ctx.drawImage(image, 0, 0, width, height);
  
    canvas.toBlob(
      function(blob) {
        const compressedImageSize = blob.size;
        const compressedImageUrl = URL.createObjectURL(blob);
  
        // Display the compressed image
        compressedImage.src = compressedImageUrl;
  
        // Update compressed image size display
        compressedSizeDisplay.textContent = (compressedImageSize / 1024).toFixed(2) + ' KB';
  
        // Enable download button with the selected file type
        downloadBtn.href = compressedImageUrl;
        downloadBtn.download = `compressed_image.${fileType}`;
        downloadBtn.style.display = 'inline-block';
      },
      `image/${fileType}`,
      compressValue / 100
    );
  });
  
  // Set the range input's min and max values
  compressLevel.min = 0;
  compressLevel.max = 100;
  compressLevel.value = 50;
  
    </script>
</body>
</html>
