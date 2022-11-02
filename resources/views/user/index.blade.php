<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">        
            <!-- <main> -->
                <!-- <div style="display: flex;">gazou</div> -->
                <table>
                    <tr>
                        <th>名前</th>
                        <!-- bladeからAuthを呼び出して取得 -->
                        <td class="deta">{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <!-- controllerなどから渡された値から取得 -->
                        <td class="deta">{{ $user->email }}</td>
                    </tr>
                </table>
                <div class="post_btn">
                    <button class="detail_btn"><a href="{{route('user.edit',$user)}}" class="a">編集</a></button>
                    <form method="post" action="{{route('user.destroy', $user)}}">
                        @csrf
                        @method('delete')
                        <button class="detail_btn" onClick="return confirm('本当に削除しますか？');">削除</button>
                    </form>
                </div>
            <!-- </main> -->
        </div>
    </div>
  </div>
</x-app-layout>