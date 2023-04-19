<x-layout.layout>
    <x-slot:title>Home</x-slot>
        {{-- <div x-data="{ city: $persist(0), userLat: $persist(0), userLng: $persist(0), zipcodes: $persist(0), acceptedCookies: $persist(false), index: []}"></div> 
        <div class="col-span-full lg:col-span-2">
            <div class="h-full py-4 px-5 text-sm text-red-600 font-semibold flex items-center justify-center border border-red-200 rounded">
            </div>
        </div> --}}
            <div class="" x-init="home = post('home/searchWithCity','id', 4, this.home)">
                <div class="pagination-left relative mx-0">
                    {{-- <div class="horizontal pointer" dir=""> --}}
                    <div class="horizontal pointer">
                        {{-- <div class="wrapper" style="transform: translate3d(-6125px, 0px, 0px); transition-duration: 300ms;"> --}}
                            <div class="wrapper" style="">
                                <div class="mx-auto">
                                    <span x-data="console.log(home)"></span>
                                        <div class="carouselItem">
                                        {{-- <template x-for="banner in banners">
                                            <a class="group relative flex justify-center" href="/">
                                                <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                                                <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                                                    <img :src="'/assets/images/'+banner.cover" :alt="banner.message" aria-hidden="true" style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0">
                                                </span>
                                            </a>
                                        </template> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                            <span class="swiper-pagination-bullet">
                                </span>
                            <span class="swiper-pagination-bullet">
                                </span>
                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active">
                                </span>
                        </div> --}}
                    </div>
                </div>
            </div>
        {{-- <x-home.top-products /> --}}
        {{-- <x-home.exclusive /> --}}
</x-layout.layout>