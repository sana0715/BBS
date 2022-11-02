<!-- ログイン後のメイン(トップ)ページ(メイン部分) -->
<x-app-layout>
    <x-slot name="header">
        <div class="acount">
            <h2 class="acount_h2">My Acount</h2>
            <div class="acoun_cont">
                <img src="" alt=""><!-- 登録画像 -->
                <div class="acount_a">
                    <!-- <p href="" class="a acount_text">{{ Auth::user()->name }}</p> -->
                    <!-- <a href="{{route('user.index')}}" class="a acount_text" style="margin: 10px 0;"><span class="user_name">ユーザー名：</span>{{ Auth::user()->image }}</a> -->
                    <!-- <img src="{{asset('storage/images/'.Auth::user()->image)}}" class="" style="height: 35px;" alt=""> -->
                    <a href="{{route('user.index')}}" class="a acount_text" style="margin: 10px 0;"><span class="user_name">ユーザー名：</span>{{ Auth::user()->name }}</a>
                    <!-- <a href="/follow_list" class="a acount_text">フォローユーザー 一覧</a> -->
                </div>
                <!-- <button><a href="{{route('user.index')}}" class="acount_edita a">編集</a></button> -->
            </div>
        </div>
        <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> -->
    </x-slot>

    
    <div>
        <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="posts">
                    <div class="posts_cont">
                        <h3 class="main_h3"><a href="/home" class="maincat_a"><img class="posts_img" src="img/117073.png" alt="">{{ Auth::user()->name }}さんの投稿</a></h3>
                    </div>  
                    <div class="posts_cont">
                        <h3 class="main_h3"><a href="/allpost" class="maincat_a"><img class="posts2_img" src="img/171329.png" alt="">みんなの投稿</a></h3>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
            <section>
                <div style="font-size:20px">
                    <a href="/create" class="main_a create" style="font-weight: bold;">新しく投稿する</a>
                </div>
                <div style="margin-top: 15px; font-size:20px">
                    <!-- <button><a href="/followList" class="maincat_a" style="font-weight: bold; margin-right: 25px;">フォローユーザーの投稿</a></button> -->
                    <button><a href="/allpost" class="maincat_a" style="font-weight: bold;">全ての投稿</a></button>
                </div>
                    <div class="mt-4">
                        <h2 class="main_h2">カテゴリー別投稿一覧</h2>
                    </div>
                    <!-- <div class="category_ttl">
                            <button>
                                <a href="/category_posts" class="maincat_a">トレーニング</a>
                            </button>
                            <button>
                                <a href="" class="maincat_a">筋トレ</a>
                            </button>
                            <button>
                                <a href="" class="maincat_a">ストレッチ・ケア</a>
                            </button>
                            <button>
                                <a href="" class="maincat_a">食事</a>
                            </button>
                            <button>
                                <a href="" class="maincat_a">リカバリー</a>
                            </button>
                            <button>
                                <a href="" class="maincat_a">用具</a>
                            </button>
                            <button>
                                <a href="" class="maincat_a">その他</a>
                            </button>
                        </div> -->
                        <!-- <a href="" class="maincat_a">筋トレ</a>
                        <a href="" class="maincat_a">ケア・ストレッチ</a>
                        <a href="" class="maincat_a">食事</a>
                        <a href="" class="maincat_a">リカバリー</a>
                        <a href="" class="maincat_a">用具</a>
                        <a href="" class="maincat_a">その他</a> -->
                    </div>
                </section>
                <section>
                    <div class="mt-3">
                        <p >{{ $posts->total() }}件が見つかりました。</p>
                    </div>
                    <div class="category_ttl">
                        @foreach($categories as $id => $category_name)
                        <button><a href="{{ route('dashboard', ['category_id'=>$id]) }}" title="{{ $category_name }}" class="maincat_a">{{ $category_name }}</a></button>
                        @endforeach
                    </div>
                    <div class="allpost">
                        @if(session('message'))
                        <div class="alert alert-dark">{{session('message')}}</div>
                        @endif
                        <div class="main_display">
                        @forelse($posts as $post)
                        {{ csrf_field() }}
                        <div class="one_cont2" style="display: block;">
                            <!-- ✨↓クリックしたら、その人のページに飛ぶようにする -->
                            <p style="font-weight: bold;"><a href="{{ route('users.show', $post->user_id)}}" class="maincat_a">{{$post->user->name}}</a></p>          

                            <img src="{{asset('storage/images/'.$post->image)}}" class="" style="height: 200px;" alt="">
                            <p>{{ $post->image }}</p>
                            <p>分野：{{ $post->category->category_name }}</p>
                            <p>内容：{{ $post->content }}</p>
                            <p>投稿日時：{{ $post->created_at }}</p>

                        </div>
                        @empty
                        @endforelse

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-5" style="margin-top: 10px;">
                    <!-- {{ $posts->links() }} -->
                    {{ $posts->appends(['category_id' => $category_id])->links() }}
                </div>
            </section>
       
                <!-- <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div> -->
            </div>
        </div>
    </div>
</x-app-layout>


