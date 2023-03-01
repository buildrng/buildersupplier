<x-layout.layout>
    <x-slot:title>Home</x-slot>
    <div x-data="{categories: null, banners: null,categories: null,categories: null}" x-init="axios
    .post('/home/searchWithCity', {id: 4 })
    .then((response)  => { home = response.data.data; banners = home.banners; categories = home.category; console.log(home)})
    .catch((error)  => {console.log(error);})">
        {{-- <div x-data="{ city: $persist(0), userLat: $persist(0), userLng: $persist(0), zipcodes: $persist(0), acceptedCookies: $persist(false), index: []}"></div> --}}
        <div class="col-span-full lg:col-span-2">
            {{-- <div class="h-full py-4 px-5 text-sm text-red-600 font-semibold flex items-center justify-center border border-red-200 rounded">

            </div> --}}
        </div>
        < x-banners.home />
    </div>

</x-layout.layout>