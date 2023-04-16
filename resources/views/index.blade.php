<x-layout.layout>
    <x-slot:title>Home</x-slot>
        {{-- <div x-data="{ city: $persist(0), userLat: $persist(0), userLng: $persist(0), zipcodes: $persist(0), acceptedCookies: $persist(false), index: []}"></div> 
        <div class="col-span-full lg:col-span-2">
            <div class="h-full py-4 px-5 text-sm text-red-600 font-semibold flex items-center justify-center border border-red-200 rounded">
            </div>
        </div> --}}
        <x-banners.home />
        {{-- <x-home.top-products /> --}}
        {{-- <x-home.exclusive /> --}}
</x-layout.layout>