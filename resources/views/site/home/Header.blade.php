<header id="header">
    <nav>
      <div class="container">
        <div class="logo">
          <h2><a class="" href="{{url('/')}}">Online Tools</a></h2>
        </div>

        <div class="links">
          <ul>
            <div class="dropdown">
              <a class="dropbtn">Image Editor 
              </a>
              <div class="dropdown-content">
                <div class="dropdown">
                  <a class="dropbtn">Image Editor 
                  </a>
                  <div class="dropdown-content">
                    <a href="{{url('compressor')}}">Image Compressor</a>
                    <a href="{{url('resizer')}}">Image Resize</a>
                    <a href="{{url('coverter')}}">Image Converter</a>
                    <a href="{{url('editor')}}">Light/Dark/Bright/Blur</a>
                    <a href="{{url('crop')}}">Crop/Merge</a>
                    <a href="{{url('rotet')}}">Image Rotate</a>
                    <a href="{{url('filp')}}">Image Filp</a>
                    <a href="{{url('gamma')}}">Image Gamma Adjust</a>
                    <a href="{{url('invert')}}">Image Invert</a>
                    <a href="{{url('vibrance')}}">Image Vibrance</a>

                  </div>
                </div>
              </div>
            </div> 
            <li>
              <a href="{{url('base64')}}">Base64 En/Decoder</a>
            </li>
            <li>
              <a href="{{url('userblog')}}">Blog</a>
            </li>
          </ul>
        </div>
        <div class="hamburger-menu">
          <div class="bar"></div>
        </div>
      </div>
    </nav>

  
  </header>
  

  <style>
    .dropdown {
  /* float: left; */
  z-index: 99999;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: rgb(34, 26, 26);
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}
@media screen and (max-width: 790px) {
  .dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: rgb(253, 245, 245);
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}
     }

.navbar a:hover, .dropdown:hover .dropbtn {
  /* background-color: red; */
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 260px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
 
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  border-bottom: 1px #8a8383 solid;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
  </style>