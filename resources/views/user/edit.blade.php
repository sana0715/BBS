<!-- 投稿編集ページ -->
<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div class="row">
      <div class="mt-6">
          <div class="card-body">
              <!-- <h4 class="h4">{{ Auth::user()->name }} さんの投稿</h4> -->
              <h5 class="h5">アカウント編集</h5>

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

                </ul>
              </div>
              @endif

              <!-- 更新した時にアラートが表示される -->
              @if(session('message'))
              <div class="alert alert-dark">{{session('message')}}</div>
              @endif

            <form method="post" action="{{ route('user.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <!-- 名前 -->
                <div class="form-group" style="margin-top: 10px;">
                    <label for="content" style="font-weight: bold; ">名前</label>
                    <input type="name" name="name" class="form-control" id="name" value="{{old('name',$user->name )}}">
                </div>
                <!-- メールアドレス -->
                <div class="form-group" style="margin-top: 10px;">
                    <label for="content" style="font-weight: bold; ">メールアドレス</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{old('email',$user->email)}}">
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