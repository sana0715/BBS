<!-- 皆の投稿一覧 -->
<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
            <!-- <main> -->
            @if(session('message'))
            <div class="alert alert-dark">{{session('message')}}</div>
            @endif
            <div class="main_display">
            @forelse($posts as $post)
            {{ csrf_field() }}
            <div class="one_cont2" style="display: block;">
            <p style="font-weight: bold;"><a href="{{ route('users.show', $post->user_id)}}" class="maincat_a">{{$post->user->name}}</a></p>          
                <img src="{{asset('storage/images/'.$post->image)}}" class="" style="height: 200px;" alt="">
                <p>{{ $post->image }}</p>
                <p>分野：{{ $post->category_id }}</p>
                <p>内容：{{ $post->content }}</p>
                <p>投稿日時：{{ $post->created_at }}</p>
                
                <!-- body内 -->
                <!-- 参考：$itemにはPostControllerから渡した投稿のレコード$itemsをforeachで展開してます -->
                @auth
                  <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
                  @if (!$post->isLikedBy(Auth::user()))
                    <span class="likes">
                    <i class="fa-solid fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{$post->likes_count}}</span>
                </span><!-- /.likes -->
                @else
                <span class="likes">
                        <i class="fa-solid fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                      <span class="like-counter">{{$post->likes_count}}</span>
                    </span><!-- /.likes -->
                  @endif
                @endauth
                   
                  
                <div>
                  
                </div>
            </div>
            @empty
            @endforelse
            <!-- </main> -->
          </div>
        </div>
        <div class="d-flex justify-content-center mb-5" style="margin-top: 10px;">
          {{ $posts->links() }}
        </div>
  </div>
</x-app-layout>
