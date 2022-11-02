<x-app-layout>
  <x-slot name="header">
  </x-slot>
  <div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">        
            <!-- <main> -->
                @foreach ($follow as $user)
                @if(in_array($user->id,Auth::user()->isFollowing()))

                 @endif
                @endforeach
            <!-- </main> -->
        </div>
    </div>
  </div>
</x-app-layout>