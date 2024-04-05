<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Header Menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="{{ asset('assets/images/dd.jpg') }}" alt="Logo" style="width: 50px; height: 50px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
        <div class="row">
            @foreach ($activeNews as $article)
                <div class="col-md-4 mt-3 news-article" data-status="{{ $article->status }}">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title text-center">{{ $article->title }}</h4>
                            <p class="card-text add-read-more show-less-content">{{ $article->description }}</p>
                            <p class="card-text pt-2 fw-bolder">{{ $article->status == 1 ? 'Active' : 'Inactive' }}</p>
                            <div class='d-flex justify-content-center mb-3'>
                                <img class='news-image img-fluid' src="{{ asset('assets/images/' . $article->image)}}" width="300px" alt='News Image'>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    $(document).ready(function(){
        var carLmt = 200;
     
      var readMoreTxt = " ...read more";
     
      var readLessTxt = " read less";
     
      $(".add-read-more").each(function () {
         if ($(this).find(".first-section").length)
            return;
         var allstr = $(this).text();
         if (allstr.length > carLmt) {
            var firstSet = allstr.substring(0, carLmt);
            var secdHalf = allstr.substring(carLmt, allstr.length);
            var strtoadd = firstSet + "<span class='second-section'>" + secdHalf + "</span><span class='read-more'  title='Click to Show More'>" + readMoreTxt + "</span><span class='read-less' title='Click to Show Less'>" + readLessTxt + "</span>";
            $(this).html(strtoadd);
         }
      });
     
      $(document).on("click", ".read-more,.read-less", function () {
         $(this).closest(".add-read-more").toggleClass("show-less-content show-more-content");
      });
    });
</script>





  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
