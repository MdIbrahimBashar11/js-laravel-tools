<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Tools</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="../home/css/style.css" />
    <style>
      img{
        max-width: 1200px;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <main>
      @include('site.home.Header')


      <section class="blog section">
        <div class="container">
          <div class="section-header">
            <h3 class="title" data-title="">Single blog</h3>
     <br>
          </div>
        
          <div class="blog-wrapper">

                <div class="blog-wrap">
                  <img  src="../product/img/{{$blog->image}}" alt="" />
                  <h1 class="title">{{$blog->name}}</h1>
                  <p class="blog-text">
                    {{$blog->description}}
                  </p>
             
                </div>

          </div>
        </div>
      </section>
    </main>

    @include('site.home.Footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./home/js/isotope.pkgd.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="./home/js/app.js"></script>
  </body>
</html>
