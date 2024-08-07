<x-app-layout>

    <div class="container mx-auto">
        @if (session('success'))
            <div class="bg-green-200 p-2 mt-5 text-green-500 rounded border border-green-500">

                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-200 p-2 mt-5 text-red-500 rounded border border-red-500">

                {{ session('error') }}
            </div>
        @endif
        @if (!$user->activity)
            <div class="bg-white p-5  shadow-sm sm:rounded-lg my-10 flex justify-between">
                <h1 class=my-auto>Create Activity</h1>
                <a href="{{ route('activites.create') }}" class="bg-blue-500 py-2 px-4 rounded text-white"> Add
                    Activity</a>
            </div>
        @else
            <div class="shadow-md p-5 bg-white mt-5 rounded-md">
                <div>
                    <h1 class="text-orange-500 text-xl font-bold">My ACtivity </h1>
                </div>
                <div class=" shadow-lg border border-gary-200 rounded-md p-5 w-1/3 mt-5">
                    <h1 class="text-gray-600 mb-1">{{ $user->activity->name }}</h1>
                    <h1 class="text-gray-600 mb-1">{{ $user->activity->date }}</h1>
                    <h1 class="text-gray-600 mb-1">{{ $user->activity->time }}</h1>


                    @php
                        $images = json_decode($user->activity->images, true);
                    @endphp

                    @if (is_array($images) && count($images) > 0)
                        <div class="grid grid-cols-3 gap-5 my-5 ">
                            @foreach ($images as $image)
                                <div>
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Image"
                                        class="product-image rounded-md drop-shadow-md">
                                </div>
                            @endforeach

                    @endif


                </div>
                <div class="grid grid-cols-2 gap-5">
                    <a href="{{ route('activites.edit', $user->activity->id) }}"
                        class="bg-blue-500 p-2 text-white text-center rounded">update</a>
                    <form action="{{ route('activites.destroy', $user->activity->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 p-2 w-full text-white text-center rounded">Delete</button>
                    </form>
                </div>


            </div>
        @endif


</x-app-layout>
