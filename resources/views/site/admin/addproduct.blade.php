<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Add Product - Dashboard HTML Template</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <!-- http://api.jqueryui.com/datepicker/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body>
    @include('site.admin.Navbar')
    
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Add Blog</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="{{ url('/addblog')}}" enctype="multipart/form-data"
                method="post" class="tm-edit-product-form" >
                  @csrf
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Blog Name
                    </label>
                    <input
                      id="name"
                      name="name"
                      type="text"
                      class="form-control validate"
                      required
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="description"
                      >Description</label
                    >
                    <div class="editor-toolbar">
                      <button class="btn btn-primary" onclick="execCommand('bold')"><strong>B</strong></button>
                      <button class="btn btn-primary" onclick="execCommand('italic')"><em>I</em></button>
                      <button class="btn btn-primary" onclick="execCommand('underline')"><u>U</u></button>
                      <button class="btn btn-primary" onclick="execCommand('insertImage')"><img src="https://via.placeholder.com/20" alt="Insert Image"></button>
                      <button class="btn btn-primary" onclick="execCommand('createLink')">Link</button>
                    </div>
                    <div class="editor-content" contenteditable="true"></div>
                    <textarea type="hidden"
                      class="form-control validate"
                      id="description"
                      rows="3"
                      required
                      name="description"
                    ></textarea>
                  </div>
                  
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                <div class="tm-product-img-dummy mx-auto">
                  <i
                    class="fas fa-cloud-upload-alt tm-upload-icon"
                    onclick="document.getElementById('fileInput').click();"
                  ></i>
                </div>
                <div class="custom-file mt-3 mb-3">
                  <input id="fileInput" type="file" style="display: none" name="image"  required />
                  <input
                    type="button"
                    class="btn btn-primary btn-block mx-auto"
                    value="UPLOAD BLOG IMAGE"
                    onclick="document.getElementById('fileInput').click();"
                  />
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Blog Now</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <!-- https://jqueryui.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $("#expire_date").datepicker();
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const editorContent = document.querySelector('.editor-content');
        const descriptionInput = document.getElementById('description');
        
        // Update the hidden input value with the editor content
        editorContent.addEventListener('input', function() {
          descriptionInput.value = editorContent.innerHTML;
        });
      });
      
      // Execute the command on the content editable element
      function execCommand(command) {
        document.execCommand(command, false, null);
      }
    </script>
  </body>
</html>
