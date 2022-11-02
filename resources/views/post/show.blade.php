<!-- (自分の)投稿詳細(= detail)ページ⭕️ -->
<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="overflow-hidden sm:rounded-lg posts_list">
                <h4 class="h4">{{ Auth::user()->name }}さんの投稿</h4>
                <!-- 投稿した時にアラートが表示される -->
                @if(session('message'))
                <div class="alert alert-dark">{{session('message')}}</div>
                @endif
                <img src="{{asset('storage/images/'.$post->image)}}" class="mx-auto" style="height: 300px;" alt="">
                <div class="detail">
                    <div><span style="font-weight: bold;">(画像ファイル：</span>{{$post->image}}<span style="font-weight: bold;">)</span></div>
                    <p style="margin-top: 10px;"><span style="font-weight: bold;">カテゴリー：</span>{{ $post->category->category_name }}</p>
                    <label for="" style="font-weight: bold;">本文：</label>
                    <p>{{$post->content}}</p>
                    <p><span style="font-weight: bold;">投稿日：</span>{{$post->created_at->diffForHumans()}}</p>
                </div>
                <div class="post_btn">
                    <button class="detail_btn" onclick="history.back()">戻る</button>
                    <button class="detail_btn"><a href="{{route('post.edit',$post)}}" class="a">編集</a></button>
                    <form method="post" action="{{route('post.destroy', $post)}}">
                        @csrf
                        @method('delete')
                        <button class="detail_btn" onClick="return confirm('本当に削除しますか？');">削除</button>
                    </form>
                </div>
        </div>
    </div>
  </div>
</x-app-layout>
