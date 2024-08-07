 <x-app-layout>


     <div class="container mx-auto  flex justify-center">



         <div class="w-1/2 my-10 shadow-md bg-white p-5 rounded-md">
             <form action="{{ route('activites.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')

                 <h1 class="text-indigo-500 text-xl font-bold mb-5">Update Activity</h1>
                 <div>
                     <x-input-label for="activityName" :value="__('Activity Name')" />
                     <x-text-input id="activityName" class="block mt-1 w-full mb-3" type="text" name="name" autofocus
                         value="{{ old('name', $activity->name) }}" />
                     <x-input-error :messages="$errors->get('name')" class="mt-2" />
                 </div>
                 <div class="grid grid-cols-2 gap-5">
                     <div>
                         <x-input-label for="date" :value="__('Date')" />
                         <x-text-input id="date" class="block mt-1 w-full mb-3" type="date" name="date"
                             value="{{ old('date', $activity->date) }}" />
                         <x-input-error :messages="$errors->get('date')" class="mt-2" />
                     </div>
                     <div>
                         <x-input-label for="time" :value="__('Time')" />
                         <x-text-input id="time" class="block mt-1 w-full mb-3" type="time" name="time"
                             value="{{ old('time', $activity->time) }}" />
                         <x-input-error :messages="$errors->get('time')" class="mt-2" />
                     </div>

                 </div>
                 <div>
                     <x-input-label for="city" :value="__('City')" />
                     <select name="location"
                         class="mb-3 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2">
                         @foreach ($cities as $city)
                             <option value="{{ $city }}" {{ $activity->location == $city ? 'selected' : '' }}>
                                 {{ $city }}
                             </option>
                         @endforeach
                     </select>

                     <x-input-error :messages="$errors->get('location')" class="mt-2" />


                 </div>
                 <div>
                     <x-input-label for="images" :value="__('Uplode Images * ')" />
                     <input id="images" name="images[]" multiple type="file" class="block mt-1 w-full mb-3" />
                     <x-input-error :messages="$errors->get('images')" class="mt-2" />
                 </div>
                 @php
                     $images = json_decode($activity->images, true);
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
         <x-primary-button>
             {{ __('Submit') }}
         </x-primary-button>
         </form>


     </div>







     </div>



 </x-app-layout>
