@extends('layouts.blog.app')
@section('title', 'Pen-It | Bloggers Heaven')

@section('header')

<header class="pt100 pb100 parallax-window-2" data-parallax="scroll" data-speed="0.5" data-image-src="{{ asset('assets/img/bg/img-bg-17.jpg') }}" data-positiony="1000">
    <div class="intro-body text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt50">
                    <h1 class="brand-heading font-montserrat text-uppercase color-light" data-in-effect="fadeInDown">
                        Blog Post
                        <small class="color-light alpha7">Articulated for You with &hearts;</small>
                    </h1>
                </div>
            </div>
        </div>

    </div>
</header>

@endsection

@section('main-content')


<div class="blog-three-mini">
    <h2 class="color-dark">{{ $post->title }}</h2>
    <div class="blog-three-attrib">
        <div><i class="fa fa-calendar"></i>{{ $post->published_at->diffForHumans() }}</div> |
        <div><i class="fa fa-pencil"></i><a href="#">{{$post->author->name}}</a></div>
        <div>
            Share:  <a href="#"><i class="fa fa-facebook-official"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
        </div>
    </div>

    <img src="{{ asset('storage/'.$post->image) }}" alt="Blog Image" class="img-responsive">
    <div class="lead mt25">
        {!! $post->content !!}
    </div>

    <div class="blog-post-read-tag mt50">
        <i class="fa fa-tags"></i> Tags:
        @foreach ($tags as $tag)
            <a href="{{ route('blog.tag', $tag->id) }}">{{$tag->name}}</a> {{ $loop->last? '' : ',' }}
        @endforeach
    </div>

</div>


<div class="blog-post-author mb50 pt30 bt-solid-1">
    <img src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src($post->author->email) }}" class="img-circle" alt="image">
    <span class="blog-post-author-name">{{ $post->author->name }}</span> <a href="https://twitter.com/booisme"><i class="fa fa-twitter"></i></a>
    <p>
        {{ $post->author->about }}
    </p>
</div>


<div class="blog-post-comment-container">

    <div id="disqus_thread"></div>
    {{-- email:dereve1305@lefaqr5.com, pass:dereve1305, disqus --}}
    <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

        var disqus_config = function () {
        this.page.url = '{{ route('blog.show', $post->id) }}';  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = '{{ $post->id }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://laravel7blog.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>

{{-- <div class="blog-post-comment-container">
    <h5><i class="fa fa-comments-o mb25"></i> 20 Comments</h5>

    <div class="blog-post-comment">
        <img src="assets/img/other/photo-2.jpg" class="img-circle" alt="image">
        <span class="blog-post-comment-name">John Boo</span> Jan. 20 2016, 10:00 PM
        <a href="#" class="pull-right text-gray"><i class="fa fa-comment"></i> Reply</a>
        <p>
            Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.
        </p>
    </div>

    <div class="blog-post-comment">
        <img src="assets/img/other/photo-4.jpg" class="img-circle" alt="image">
        <span class="blog-post-comment-name">John Boo</span> Jan. 20 2016, 10:00 PM
        <a href="#" class="pull-right text-gray"><i class="fa fa-comment"></i> Reply</a>
        <p>
            Adipisci velit sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.
        </p>

        <div class="blog-post-comment-reply">
            <img src="assets/img/other/photo-2.jpg" class="img-circle" alt="image">
            <span class="blog-post-comment-name">John Boo</span> Jan. 20 2016, 10:00 PM
            <a href="#" class="pull-right text-gray"><i class="fa fa-comment"></i> Reply</a>
            <p>
                Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.
            </p>
        </div>

    </div>

    <div class="blog-post-comment">
        <img src="assets/img/other/photo-1.jpg" class="img-circle" alt="image">
        <span class="blog-post-comment-name">John Boo</span> Jan. 20 2016, 10:00 PM
        <a href="#" class="pull-right text-gray"><i class="fa fa-comment"></i> Reply</a>
        <p>
            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur adipisci velit.
        </p>
    </div>

    <button class="button button-default button-sm center-block button-block mt25 mb25">Load More Comments</button>


</div>

<div class="blog-post-leave-comment">
    <h5><i class="fa fa-comment mt25 mb25"></i> Leave Comment</h5>

    <form>
        <input type="text" name="name" class="blog-leave-comment-input" placeholder="name" required>
        <input type="email" name="name" class="blog-leave-comment-input" placeholder="email"  required>
        <input type="url" name="name" class="blog-leave-comment-input" placeholder="website">
        <textarea name="message" class="blog-leave-comment-textarea"></textarea>
        <button class="button button-pasific button-sm center-block mb25">Leave Comment</button>
    </form>

</div> --}}

@endsection
