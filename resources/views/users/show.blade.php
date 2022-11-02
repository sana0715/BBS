<x-app-layout>
    <x-slot name="header">
        <!-- <tr> -->
            <!-- <th>名前</th> -->
            <!-- bladeからAuthを呼び出して取得 -->
            <!-- <td class="deta">{{ Auth::user()->name }}</td> -->
            <!-- </tr> -->
        </x-slot>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">        
                    <!-- <main> -->
                    <table>
                        <div>
                            <!-- gazou -->
                        </div>
                        <div class="mb-4">
                            <p style="font-weight: bold;">{{ $user_name }} <span>さんのページ</span></p>
                        </div>
                        <div class="justify-content-end flex-grow-1 mb-4">
                            @if(Auth::id() != $user_flg)  <!-- 訪れたユーザーが自分かどうか -->
                            @if (Auth::user()->isFollowing($user->id))  <!-- もしフォローしていれば↓の処理を行う -->
                                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    
                                    <button type="submit" class="btn btn-secondary">フォロー中</button>
                                </form>
                                @else  <!-- もしフォローしていなければ↓の処理を行う -->
                                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                    {{ csrf_field() }}
    
                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </form>
                            @endif
                            @endif
 



                    </table>
                    <div class="main_display">
                        @foreach ($posts as $post)
                        <div class="one_cont2" style="display: block;">
                            <p href="{{ route('users.show', $post->user_id) }}" style="font-weight: bold;">{{ $user_name }}</p>
                            <img src="{{asset('storage/images/'.$post->image)}}" class="" style="height: 200px;" alt="">
                            <p >{{ $post->image }}</p>
                            <p>分野：{{ $post->category->category_name }}</p>
                            <p>内容：{{ $post->content }}</p>
                            <p>投稿日時：{{ $post->created_at }}</p>
                        </div>   
                        @endforeach
                    </div> 
                    {{-- ページネーション --}}
                    <div class="d-flex justify-content-center mb-5">
                        {{ $posts->links() }}
                    </div>
                <!-- </main> -->
            </div>  
        </div>
    </div>
    
        </div>
    </div>
  </div>
</x-app-layout>