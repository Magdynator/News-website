@extends('website.template.master')

@section('content')
 <!-- Page Header -->
 <header class="masthead" style="background-image: url({{ asset('website/img/home-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Clean Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 mx-auto">
        @foreach($news as $new_news)
        <div class="post-preview">
          <a href="{{ url('onenews/'. $new_news->id) }}">
            <h2 class="post-title">
            {{ $new_news-> title }}
            </h2>
            <img src= {{ $new_news->img }}> </br>
          </a>
          <p class="post-meta">
            <h5> {{ $new_news->name }}</h5>
            {{ $new_news->date }}
           
            
            </p>
        </div>
        <hr>
        @endforeach
        <!-- Pager -->
        <div class="clearfix mt-4">
        {{ $news->links() }}
        </div>
      </div>

      <div class = "col-lg-4 col-md-4">
        <div class="news">
          <h2 class = "news-list">Writers</h2>
          @foreach($names as $name)

          <ul class = "news-list">
            <li><a href="{{ url('news/'. $name->id) }}">{{ $name->name}}</a></li>
          </ul>
          @endforeach

        </div>
      </div>
    </div>
  </div>



@endsection()