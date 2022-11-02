<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">        
            <!-- <main> -->
            <div class="pt-2">
                <p class="h3 border-bottom border-secondary pb-3">プロフィール編集</p>
            </div>
            {!! Form::open(['route' => ['profile_edit'], 'method' => 'PUT']) !!}
            {!! Form::hidden('id',$user->id) !!}
            <div class="m-3">
                <div class="form-group pt-1">
                    {{Form::label('name','ユーザー名')}}
                    {{Form::text('name', $user->name, ['class' => 'form-control', 'id' =>'name'])}}
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group pt-2">
                    {{Form::label('email','メールアドレス')}}
                    {{Form::email('email', $user->email, ['class' => 'form-control', 'id' =>'email'])}}
                    <span class="text-danger">{{$errors->first('email')}}</span>
                </div>
                <div class="form-group pull-right">
                    {{Form::submit(' 更新する ', ['class'=>'btn btn-success rounded-pill'])}}
                </div>
            </div>
            {!! Form::close() !!}

            <!-- </main> -->
        </div>
    </div>
  </div>
</x-app-layout>