<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Product Page - Admin HTML Template</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
    @include('site.admin.Navbar')
   
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container">
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">Blog NAME</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                <tr>
                  <th scope="row"></th>
                  <td class="">{{$product->name}}</td>
                  <td>{{$product->description}}</td>
                  <td>
                     <img class="image"src="product/img/{{$product->image}}" alt="">
                  </td>
                  <td>
                    <a href="{{url('/delete_blog', $product->id)}}" class="tm-product-delete-link">
                      <i class="far fa-trash-alt tm-product-delete-icon"></i>
                    </a>
                  </td>
                  <td scope=""><a class="btn btn-outline-success" href="{{url('/update', $product->id)}}">Update</a></td>
                </tr>
                @endforeach

                </tbody>
              </table>
            </div>
            <!-- table container -->
            <a
              href="{{ url('/addblogpage')}}"
              class="btn btn-primary btn-block text-uppercase mb-3">Add new Blog</a>
          </div>
        </div>

      </div>
    </div>
  

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script>
      $(function() {
        $(".tm-product-name").on("click", function() {
          window.location.href = "edit-product.html";
        });
      });
    </script>
  </body>
</html>


<style>
  .image{
     width: 100px;
  }
</style>
