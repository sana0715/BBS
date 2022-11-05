<!-- 自分の投稿一覧 -->
<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
            <!-- <main> -->
              <h4 class="h4">{{ Auth::user()->name }}さんの投稿</h4>
              <!-- 投稿した時にアラートが表示される -->
                  @if(session('message'))
                  <div class="alert alert-dark">{{session('message')}}</div>
                  @endif
                <div class="main_display">
                @forelse($posts as $post)
                {{ csrf_field() }}
                <div class="one_cont2" style="display: block;">
                    <img src="{{asset('storage/images/'.$post->image)}}" class="" style="height: 200px;" alt="">
                    <!-- <p>{{ $post->image }}</p> -->
                    <!-- <p>分野：{{ $post->category_id }}</p> -->

                    <p>内容：{{ $post->content }}</p>
                    <p>投稿日時：{{ $post->created_at }}</p>
                    <div>
                    <a href="{{ action('PostController@show', $post->id)}}" class="main_a detail_a" style="font-weight: bold;">詳しく見る</a>
                    </div>
                </div>
                @empty
                @endforelse
                <div class="d-flex justify-content-center mb-5" style="margin-top: 10px;">

                </div>
                
            <!-- </main> -->
        </div>
    </div>
  </div>
</x-app-layout>
