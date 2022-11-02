<!-- 新規投稿⭕️ -->
<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div class="row">
      <div class="mt-6">
          <div class="card-body">
              <h4 class="h4">{{ Auth::user()->name }} さんの投稿</h4>
              <h5 class="h5">新規投稿</h5>

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

            <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- 画像 -->
                <div class="form-group">
                    <label for="image">画像</label>
                    <div class="col-md-6">
                        <input type="file" id="image" name="image">
                    </div>
                </div>

                <!-- ↓カテゴリーに変更する -->
                <!--  カテゴリープルダウン -->
                <div class="form-group">
                  <label for="category-id">{{ __('カテゴリー') }}</label>
                  <select class="form-control" id="category_id" name="category_id" value="{{old('category_id')}}">
                      @foreach ($categories as $category)
                      <option value="" selected hidden>選択してください</option>
                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                      @endforeach
                  </select>
                </div>
                
                <!-- 本文 -->
                <div class="form-group">
                    <label for="content">本文</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{old('content')}}</textarea>
                </div>

                <!-- 送信ボタン -->
                <div class="confirm_btn">
                    <x-button class="btn create_btn" id="submit" type="submit">
                        投稿
                    </x-button>
                </div>

            </form>
        </div>
    </div>
  </div>
</x-app-layout>