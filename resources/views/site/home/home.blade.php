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
    <style>
        .contant{
            max-width: 1400px;
            margin: 0 auto;
        }
        .rows{
            display: flex;
        }
        .rows .cl{
            margin: 0 10px;
            border-left: 4px #6b44e0 solid;
            
        }
        .cl .cd{
            box-shadow: 0 0 20px rgb(185, 179, 179);
            padding: 8px;
            border-radius: 8px;
            padding-left: 20px;
        }
        .cl h3{
            font-size: 25px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 
            'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin-bottom: 8px;
        }
        .cl p{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            line-height: 25px;
            font-size: 15px;
            
        }
        @media screen and (max-width: 790px) {
          .rows{
            display: block;
            margin: 0 auto;
        
        }
        .rows .cl{
          margin: 15px 0;
        }
       
     }
     a{
          color: black;
        }
    </style>
  </head>
  <body>
    
    <main>
      @include('site.home.Header')

      <section class="services section" id="services">
        <div class="container">
          <div class="section-header">
            <h3 class="title" data-title="">Services</h3>
            <p class="text">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias,
              vero?
            </p>
            <br> <br> <br>
          </div>
          <div class="contant">
            <div class="rows">
              <a href="{{url('resizer')}}">
                <div class="cl">
                  <div class="cd">
                      <h3>Image Resize</h3><br>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                  </div>
              </div>
              </a>
                <a href="{{url('compressor')}}">
                  <div class="cl">
                    <div class="cd">
                        <h3>Image Compressor</h3><br>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                    </div>
                </div>
                </a>
              <a href="{{url('coverter')}}"">
                <div class="cl">
                  <div class="cd">
                      <h3>Image Converter</h3><br>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                  </div>
              </div>
              </a>
              <a href="{{url('editor')}}">
                <div class="cl">
                  <div class="cd">
                      <h3>Light/Dark/Bright/Blur</h3> <br>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                      </p>
                  </div>
              </div>
              </a>
               
            </div>
        </div>
        <br> <br> <br>
        <div class="contant">
          <div class="rows">
            <a href="{{url('crop')}}">
              <div class="cl">
                <div class="cd">
                    <h3>Image Crop/Merge</h3><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                </div>
            </div>
            </a>
              <a href="{{url('rotet')}}">
                <div class="cl">
                  <div class="cd">
                      <h3>Image Rotate</h3><br>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                  </div>
              </div>
              </a>
            <a href="{{url('filp')}}">
              <div class="cl">
                <div class="cd">
                    <h3>Image Filp</h3><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                </div>
            </div>
            </a>
            <a href="{{url('gamma')}}">
              <div class="cl">
                <div class="cd">
                    <h3>Image Gamma Adjust</h3><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                </div>
            </div>
            </a>
             
          </div>
      </div>
      <br> <br> <br>
      <div class="contant">
        <div class="rows">
          <a href="{{url('invert')}}">
            <div class="cl">
              <div class="cd">
                  <h3>Image Color Invert</h3><br>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
              </div>
          </div>
          </a>
            <a href="{{url('vibrance')}}">
              <div class="cl">
                <div class="cd">
                    <h3>Image Color Vibrance</h3><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                </div>
            </div>
            </a>   
            <a href="{{url('base64')}}">
              <div class="cl">
                <div class="cd">
                    <h3>Base64 En/Decoder</h3><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit <br>
                    </p>
                </div>
            </div>
            </a>   
        </div>
    </div>
        </div>
      </section>

      <section class="blog section">
        <div class="container">
          <div class="section-header">
            <h3 class="title" data-title="">Our blog</h3>
            <p class="text">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo,
              deserunt?
            </p>
          </div>
        
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
                      {{-- <p class="blog-text">
                        {{$blog->description}}
                      </p> --}}
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
