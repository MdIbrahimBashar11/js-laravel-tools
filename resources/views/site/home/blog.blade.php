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
    <link rel="stylesheet" href="./home/css/style.css" />
  </head>
  <body>
    <main>
      @include('site.home.Header')


      <section class="blog section">
        <div class="container">
          <div class="section-header">
            <h3 class="title" data-title="">Our blog</h3>
            <p class="text">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo,
              deserunt?
            </p>
          </div>
           <br> <br>
          <div class="blog-wrapper">
            @foreach ($blogs as $blog)
              <a href="{{url('blog_details', $blog->id)}}">
                <div class="blog-wrap">

                  <div class="blog-card">
                    <div class="blog-image">
                      <img  src="product/img/{{$blog->image}}" alt="" />
                    </div>
            
                    <div class="blog-content">
                      <div class="blog-info">
                        <h5 class="blog-user"><i class="fas fa-user"></i>Admin</h5>
                      </div>
                      <h3 class="title-sm">{{$blog->name}}</h3>
    
                    </div>
                  </div>
                </div>
              </a>
            @endforeach
            
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
