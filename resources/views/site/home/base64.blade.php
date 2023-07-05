<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./home/css/style.css" />
  <title>Base64 JPG Encoder</title>

  <style>
      .encoder, .decoder{
    margin: 0 auto;
    width: 60%;
    text-align: center;
  }
  .row{
    display: flex;
    width: 100%;
  }
  textarea{
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
        .encoder, .decoder{
          margin: 0 auto;
          width: 95%;
          text-align: center;
        }

        .row{
          display: block;
          width: 100%;
        }
        img{
          max-width: 400px;
         max-height: 430px;
         margin: 0 auto;
    }
     }
    img{
          max-width: 600px;
         max-height: 630px;
         margin: 0 auto;
    }
  </style>
</head>
<body>
  @include('site.home.Header')
  <br> <br>
   <div class="encoder">
    <h1 class="title">Base64 JPG Encoder</h1> 
    <br> <br> <br>
    <div class="row">
      {{-- <input class="btn" type="file" id="image-input"> --}}
      <input id="image-input" type="file" style="display: none" name="image"  required />
      <input
        type="button"
        class="btn btn-primary btn-block mx-auto"
        value="UPLOAD IMAGE"
        onclick="document.getElementById('image-input').click();"
      />
    <button class="btn" onclick="encodeImage()">Encode to Base64</button>
    </div> <br>
     <div class="row">
      <textarea id="encoded-text" rows="10" cols="50"></textarea>
     </div>
    <div class="row">
      <button class="btn" onclick="copyEncodedText()">Copy Encoded Text</button>
    <button class="btn" onclick="downloadEncodedText()">Download Text File</button>
    </div>
   </div>
    <br> <br> <br> <hr> <br><br>
 
     <br> <br>
    <div class="decoder">
      <h1 class="title">Base64 JPG Decoder</h1>
  
      <textarea id="base64Input" placeholder="Paste base64-encoded JPG code here"></textarea>
      <br>
      <button class="btn" id="decodeBtn">Decode</button>
      <br> <br>
      <div id="preview-container">
        <img id="preview-image" src="" alt="Preview Image">
      </div>
      <br>
      <a href="#" class="btn" id="downloadLink" download="decoded_image.jpg" style="display: none;">Download</a>
      
        <br> <br>
    </div>
    <div class="container">
      <h2>{{$setting->name}}</h2> <br>
      <p style="font-size: 17px;">{{$setting->description}}</p>
   </div>
   <br> <br> <br>


    @include('site.home.Footer')
    <script src="./home/js/app.js"></script>
  <script>
 function encodeImage() {
  const imageInput = document.getElementById('image-input');
  const file = imageInput.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const base64 = e.target.result.split(',')[1];
      const encodedText = document.getElementById('encoded-text');
      encodedText.value = base64;
    };
    reader.readAsDataURL(file);
  }
}

function copyEncodedText() {
  const encodedText = document.getElementById('encoded-text');
  encodedText.select();
  document.execCommand('copy');
  alert('Encoded text copied to clipboard!');
}

function downloadEncodedText() {
  const encodedText = document.getElementById('encoded-text').value;
  const element = document.createElement('a');
  const file = new Blob([encodedText], {type: 'text/plain'});
  element.href = URL.createObjectURL(file);
  element.download = 'encoded_text.txt';
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}

  </script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
const base64Input = document.getElementById('base64Input');
const decodeBtn = document.getElementById('decodeBtn');
const previewImage = document.getElementById('preview-image');
const downloadLink = document.getElementById('downloadLink');

// Decode and preview the image when the "Decode" button is clicked
decodeBtn.addEventListener('click', function() {
  const base64Code = base64Input.value.trim();
  const decodedImageURL = decodeBase64JPG(base64Code);
  if (decodedImageURL) {
    previewImage.src = decodedImageURL;
    downloadLink.href = decodedImageURL;
    downloadLink.style.display = 'inline';
  } else {
    previewImage.src = '';
    downloadLink.style.display = 'none';
  }
});

// Decode the base64-encoded JPG and return the image URL
function decodeBase64JPG(base64Code) {
  const binaryString = window.atob(base64Code);
  const byteArray = new Uint8Array(binaryString.length);
  for (let i = 0; i < binaryString.length; i++) {
    byteArray[i] = binaryString.charCodeAt(i);
  }
  const blob = new Blob([byteArray], { type: 'image/jpeg' });
  return URL.createObjectURL(blob);
}
});

</script>
</body>
</html>
