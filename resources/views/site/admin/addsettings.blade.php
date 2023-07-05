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
                <h2 class="tm-block-title d-inline-block">Add Settings</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="{{ url('/addsettings')}}" enctype="multipart/form-data"
                method="post" class="tm-edit-product-form" >
                  @csrf
                  <div class="form-group mb-3">
                    <label
                      for="name"
                      >Name
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
                    <textarea
                      class="form-control validate"
                      rows="3"
                      required
                      name="description"
                    ></textarea>
                  </div>
                  
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Settings</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">
        <div class="row tm-content-row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
              <div class="tm-product-table-container">
                <table class="table table-hover tm-table-small tm-product-table">
                  <thead>
                    <tr>
                      <th scope="col">&nbsp;</th>
                      <th scope="col">NAME</th>
                      <th scope="col">Description</th>
                      <th scope="col">Update</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($settings as $setting)
                  <tr>
                    <th scope="row"></th>
                    <td class="">{{$setting->name}}</td>
                    <td>{{$setting->description}}</td>
                    <td scope=""><a class="btn btn-outline-success" href="{{url('/updateset', $setting->id)}}">Update</a></td>
                  </tr>
                  @endforeach
  
                  </tbody>
                </table>
              </div>
              <!-- table container -->
            </div>
          </div>
  
        </div>
      </div>
  

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
  </body>
</html>
