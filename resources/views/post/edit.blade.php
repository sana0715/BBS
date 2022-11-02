<!-- 投稿編集ページ -->
<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div class="row">
      <div class="mt-6">
          <div class="card-body">
              <h4 class="h4">{{ Auth::user()->name }} さんの投稿</h4>
              <h5 class="h5">投稿編集</h5>

              <!-- もしエラーがあったら、エラーメッセージが表示される -->
              @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach

                    @if(empty($errors->first('image')))
                    <li>画像ファイルは、再度選択してください。</li>
                    @endif

                    @if(empty($errors->first('category_id')))
                    <li>カテゴリーは、再度選択してください。</li>
                    @endif
                </ul>
              </div>
              @endif

              <!-- 投稿した時にアラートが表示される -->
              @if(session('message'))
              <div class="alert alert-dark">{{session('message')}}</div>
              @endif

            <form method="post" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <!-- 画像 -->
                <div class="form-group">
                <img src="{{asset('storage/images/'.$post->image)}}" class="mx-auto" style="height: 300px; margin-top: 5px;" alt="">
                <div><span style="margin-top: 5px; font-weight: bold;">(画像ファイル：</span>{{$post->image}}<span style="margin-top: 5px; font-weight: bold;">)</span></div>
                    <label for="image" style="margin-top: 10px; font-weight: bold;">画像(1MBまで)</label>
                    <div class="col-md-6" style="margin-top: 3px;">
                        <input type="file" id="image" name="image">
                    </div>
                </div>

                <!-- ↓カテゴリーに変更する -->
                <!--  カテゴリープルダウン -->
                <label for="content" style="margin-top: 10px; font-weight: bold;">カテゴリー</label>
                <select style="margin-top: 3px;"
                id="category_id"
                name="category_id"
                class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" 
                        @if ($post->category_id == $id) 
                            selected
                        @endif
                    >{{ $name }}</option>
                @endforeach
            </select>
                
                <!-- 本文 -->
                <div class="form-group" style="margin-top: 10px;">
                    <label for="content" style="font-weight: bold; ">本文</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="10" style="margin-top: 3px;">{{old('content',$post->content)}}</textarea>
                </div>

                <!-- 送信ボタン -->
                <div class="confirm_btn">
                    <!-- <button class="detail_btn" onclick="history.back(-1)">戻る</button> -->
                    <button class="create_btn detail_btn" id="submit" type="submit">
                        更新
                    </button>
                </div>

            </form>
        </div>
    </div>
  </div>
</x-app-layout>