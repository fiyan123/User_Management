<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-9">
                    <div id="colorlib-logo"><a href="index.html">Article Wear Website</a></div>
                </div>
                <div class="col-sm-5 col-md-3">
                    <form action="/users" class="search-wrap" id="searchForm">
                        <div class="form-group">
                            <input type="search" id="searchInput" class="form-control search" placeholder="Search">
                            <button class="btn btn-primary submit-search text-center" type="submit"><i
                                    class="icon-search"></i></button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-left menu-1">
                    <ul>
                        <li class="active"><a href="/">Beranda</a></li>
                        <li class="has-dropdown">
                            @auth
                            <a>Hi, {{ Auth::user()->name }}</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('home') }}">Home</a></li>
                            </ul>
                            @else
                        <li class="cart"><a href="{{ route('login') }}">Login</a></li>
                        @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sale">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center">
                    <div class="row">
                        <div class="owl-carousel2">
                            <div class="item">
                                <div class="col">
                                    <h3><a href="#">"Dalam era digital yang terus berkembang, data telah menjadi
                                            komoditas berharga."</a></h3>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col">
                                    <h3><a href="#">"Data telah mengubah lanskap bisnis, memberikan peluang baru, dan
                                            menjadi pilar fundamental."</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#searchForm').submit(function(event) {
          event.preventDefault(); // Mencegah pengiriman form secara default
    
          var searchInput = $('#searchInput').val(); // Mendapatkan nilai input pencarian
    
          // Lakukan pemrosesan pencarian (misalnya, panggil fungsi Ajax untuk mengambil data terkait pencarian)
          // Di sini, saya hanya memberikan contoh sederhana dengan menampilkan pesan hasil pencarian ke dalam elemen "searchResults"
          var searchResults = $('#searchResults');
          searchResults.empty(); // Menghapus hasil pencarian sebelumnya (jika ada)
    
          if (searchInput.trim() !== '') {
            var message = 'Anda mencari: ' + searchInput;
            searchResults.text(message);
          } else {
            searchResults.text('Masukkan kata kunci pencarian.');
          }
        });
      });
    </script>
</nav>