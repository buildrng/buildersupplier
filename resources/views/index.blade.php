<x-layout.layout>
    <x-slot:title>Home</x-slot>
    <div x-data="{home: []}" x-init="fetch('/api/v1/home/searchWithCity?id=4', { method: 'post', headers: {'Accept': 'application/json','Content-Type': 'application/json'}}).then((response) => response.json()).then((response) => home = response.data).catch((err) => console.log(err))">
        
        {{-- Banners --}}
        <div class="banner relative mx-0">
                <template x-for="banner in home.banners">
                    <a class="group relative flex justify-center" :href="'/promo'+banner.link+'/'">
                        <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                            <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                                <img :src="'/assets/images/'+banner.cover" :alt="banner.message" style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0">
                            </span>
                        </span>
                        <span class="absolute text-white text-5xl top-2/4" x-text="banner.message">
                        </span>
                    </a>
                </template>
                {{-- <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                    <span class="swiper-pagination-bullet">
                        </span>
                    <span class="swiper-pagination-bullet">
                        </span>
                    <span class="swiper-pagination-bullet swiper-pagination-bullet-active">
                        </span>
                </div> --}}
        </div>

        {{-- Categories --}}
        <div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
            <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
                <div class="flex items-center justify-between pb-0.5 my-4 md:my-5 lg:my-6 2xl:my-7 3xl:my-8">
                    <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                        {{__('home.shop_by_category')}}
                    </h3>
                </div>

                <div class="carouselWrapper relative">
                    <div class="swiper">
                        <div class="group flex">
                            <template x-for="category in home.category">
                                <a class="flex justify-center text-center flex-col" :href="'/category/'+category.slug">
                                    <div class="relative inline-flex mb-3.5 md:mb-4 lg:mb-5 xl:mb-6 ml-auto mr-5 rounded-full">
                                        <div class="flex">
                                            <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                                <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                                        <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27180%27%20height=%27180%27/%3e">
                                                </span>
                                                <img :alt="category.name" x-srcset="'/assets/images/category/'+category.cover" :src="'/assets/images/category/'+category.cover" class="object-cover bg-gray-300 rounded-full" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                                            </span>
                                        </div>
                                        <div class="absolute h-full w-full flex items-center justify-center">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="text-white text-base sm:text-xl lg:text-2xl xl:text-3xl transform opacity-0 scale-0 transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:scale-100" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="text-heading text-sm md:text-base xl:text-lg font-semibold capitalize">
                                        <span x-text="category.name"></span>
                                    </h4>
                                </a>
                            </template>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Discounted Products --}}
        <div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
            <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
                <div class="flex items-center justify-between pb-0.5 my-4 md:my-5 lg:my-6 2xl:my-7 3xl:my-8">
                    <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                        {{__('home.home_products')}}
                    </h3>
                </div>
            <div class="grid grid-cols-4 gap-3 lg:gap-5 xl:gap-7">
                <div class="col-span-full 3xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-5 xl:gap-7 ">
                    <template x-for="product in home.homeProducts">
                        <a :href="'/product/'+product.slug">
                        <div class="group box-border overflow-hidden flex rounded-md cursor-pointer items-center border border-gray-100 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:shadow-listProduct" x-title="product.name" >
                            <div class="flex flex-shrink-0 w-32 sm:w-44 md:w-36 lg:w-44">
                                <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                    <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                        <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27176%27%20height=%27176%27/%3e">
                                    </span>
                                        <img :alt="product.name" :src="'assets/images/'+product.cover" class="bg-gray-300 object-cover rounded-s-md" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" x-srcset="'assets/images/'+product.cover'assets/images/'+product.cover+' 2x'">
                                        <img :alt="product.name" :src="'assets/images/'+product.cover" class="bg-gray-300 object-cover rounded-s-md" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" x-srcset="'assets/images/'+product.cover, 'assets/images/'+product.cover+' 2x'">
                                </span>
                                    </div>
                                        <div class="w-full overflow-hidden p-2 px-4 lg:px-5 2xl:px-4">
                                        <h2 class="truncate mb-1 font-semibold text-sm sm:text-base md:mb-1.5 pb-0 text-heading">
                                            <span x-text="product.name">
                                            </span>
                                        </h2>
                                        <p class="text-body text-xs lg:text-sm leading-normal xl:leading-relaxed max-w-[250px] truncate">
                                            <span x-text="product.descriptions">

                                            </span>
                                        </p>
                                        <div class="font-semibold text-sm sm:text-base mt-1.5 space-s-2 sm:text-xl md:text-base lg:text-xl md:mt-2.5 2xl:mt-3 text-heading">
                                            <span class="inline-block false">$<span x-text="product.sell_price">

                                            </span>
                                        </span>
                                        <del class="sm:text-base font-normal text-gray-800">
                                            $<span x-text="product.original_price">

                                            </span>
                                        </del>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>       

        {{-- Stores --}}
        <div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
            <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
                <div class="flex items-center justify-between pb-0.5 my-4 md:my-5 lg:my-6 2xl:my-7 3xl:my-8">
                    <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                        {{__('home.stores_near_you')}}
                    </h3>
                </div>

                <div class="carouselWrapper relative dotsCircle ">
                    <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                        <div class="swiper-wrapper">
                            <template x-for="store in home.stores">
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev px-1.5 md:px-2.5 xl:px-3.5">
                                    <div class="mx-auto">
                                        <a class="h-full relative overflow-hidden" :href="'/stores/'+store.slug">
                                            <h4 class="text-heading text-sm md:text-base xl:text-lg font-semibold capitalize">
                                                <span x-text="store.name">
                                                    </span> at <span x-text="store.address">

                                                    </span>
                                            </h4>
                                            <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                                <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                                    <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%271440%27%20height=%27570%27/%3e">
                                                </span>
                                                    <img :alt="store.name" :src="'assets/images/'+store.cover" class="bg-gray-300 object-cover w-full rounded-md" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Brands --}}
        <div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
            <div class="mb-10 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
                <div class="flex items-center justify-between pb-0.5 my-4 md:my-5 lg:my-6 2xl:my-7 3xl:my-8">
                    <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">
                        {{__('home.top_brands')}}
                    </h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 md:gap-3 lg:gap-5 xl:gap-7">
                    <template x-for="brand in home.brands">
                        <a class="group flex justify-center text-center relative overflow-hidden rounded-md" :href="'/brand/'+brand.name">
                            <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27428%27%20height=%27428%27/%3e">
                            </span>
                            <img :alt="brand.name" :src="'/assets/images/'+brand.logo" class="rounded-md object-cover transform transition-transform ease-in-out duration-500 group-hover:rotate-6 group-hover:scale-125" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" x-srcset="'/assets/images/'+brand.logo, '/assets/images/'+brand.logo+' 2x'">
                        </span>
                            <div class="absolute top left bg-black w-full h-full opacity-50 transition-opacity duration-500 group-hover:opacity-80">
                                </div>
                            <div class="absolute top left h-full w-full flex items-center justify-center p-8">
                                <img :src="'/assets/images/'+brand.logo" :alt="brand.name" class="flex-shrink-0">
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>


        {{-- Popular Products --}}
        <div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
            <div class="mb-12 md:mb-14 xl:mb-16 border border-gray-300 rounded-md pt-5 md:pt-6 lg:pt-7 pb-5 lg:pb-7 px-4 md:px-5 lg:px-7">
                <div class="flex justify-between items-center flex-wrap mb-5 md:mb-6">
                    <div class="flex items-center justify-between -mt-2 mb-0">
                        <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading">{{__('home.top_products')}}</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-x-3 md:gap-x-5 xl:gap-x-7 gap-y-4 lg:gap-y-5 xl:gap-y-6 2xl:gap-y-8">
                        <template x-for="product in home.topProducts">
                            <div class="group box-border overflow-hidden flex rounded-md cursor-pointer  bg-white pe-0 md:pb-1 flex-col items-start" role="button" x-title="product.name">
                                <div class="flex mb-3 md:mb-3.5 pb-0">
                                    <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                                        <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px; max-width: 100%;">
                                            <img style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px none; margin: 0px; padding: 0px;" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27324%27%20height=%27324%27/%3e">
                                        </span>
                                        <img :alt="product.name" :src="'/assets/images/'+product.cover" class="bg-gray-300 object-cover rounded-s-md rounded-md transition duration-150 ease-linear transform group-hover:scale-105" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" x-srcset="'/assets/images/'+product.cover, '/assets/images/'+product.cover+' 2x'">
                                    </span>
                                        <div class="absolute top-3.5 md:top-5 3xl:top-7 start-3.5 md:start-5 3xl:start-7 flex flex-col gap-y-1 items-start">
                                            </div>
                                        </div>
                                        <div class="w-full overflow-hidden p-2 ps-0">
                                            <h2 class="truncate mb-1 font-semibold md:mb-1.5 text-sm sm:text-base md:text-sm lg:text-base xl:text-lg text-heading">
                                                <span x-text="product.name">

                                                </span>
                                            </h2>
                                            <p class="text-body text-xs lg:text-sm leading-normal xl:leading-relaxed max-w-[250px] truncate">
                                                <span x-text="product.descriptions">

                                                </span>
                                            </p>
                                            <div class="font-semibold text-sm sm:text-base mt-1.5 space-s-2 sm:text-xl md:text-base lg:text-xl md:mt-2.5 2xl:mt-3 text-heading">
                                                <span class="inline-block false">
                                                    $<span x-text="product.sell_price">
                                                        </span>
                                                </span>
                                                <del class="sm:text-base font-normal text-gray-800">
                                                    $<span x-text="product.original_price">
                                                        </span>
                                                </del>
                                                </div>
                                            </div>
                                        </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        

        {{-- Download Mobile App Promo --}}
        {{-- <div class="flex justify-between items-end rounded-lg bg-gray-200 pt-5 md:pt-8 lg:pt-10 xl:pt-14 px-6 md:px-12 lg:px-20 2xl:px-24 3xl:px-36">
            <div class="flex-shrink-0 w-full sm:w-60 md:w-96 lg:w-auto lg:max-w-lg xl:max-w-xl lg:flex lg:items-center pb-5 md:pb-8 lg:pb-12 xl:pb-16">
                <div class="py-4 md:py-6 xl:py-8 text-center sm:text-start">
                <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading -mt-1 mb-2 md:mb-3 lg:mb-3.5 xl:mb-4">
                    BuilderSupplier App</h3>
                <h2 class="text-heading text-md sm:text-xl md:text-3xl xl:text-4xl 2xl:text-5xl font-normal leading-7 sm:leading-8 md:leading-snug xl:leading-relaxed 2xl:leading-snug mb-6 md:mb-8 lg:mb-9 xl:mb-12 2xl:mb-14 lg:pe-20 2xl:pe-0">
                <span> Download now! To Order Your <strong>Construction Products</strong> &amp; From Any Covered <strong>Location</strong> </span>
                </h2>
            <div class="flex justify-center sm:justify-start space-s-2 md:space-s-3 px-6 sm:px-0">
                <a class="inline-flex transition duration-200 ease-in hover:box-shadow hover:opacity-80" href="/#">
                    <img src="/assets/images/app-store.svg" alt="App Store" class="w-36 lg:w-44 xl:w-auto rounded-md" width="209" height="60">
                </a>
                    <a class="inline-flex transition duration-200 ease-in hover:box-shadow hover:opacity-80" href="/#">
                        <img src="/assets/images/play-store.svg" alt="Play Store" class="w-36 lg:w-44 xl:w-auto rounded-md" width="209" height="60">
                    </a>
                    </div>
                </div>
            </div>
            <div class="hidden sm:flex items-end ps-4 -me-0.5 2xl:-me-1.5 w-60 md:w-72 lg:w-96 xl:w-auto">
                <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                    <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                        <img style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27375%27%20height=%27430%27/%3e">
                    </span>
                    <img alt="Screenshot of Mobile App" src="" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%" srcset=" 1x,  2x">
                    <noscript>
                        <img alt="Apple App" srcSet=" 1x,  2x" src="" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"/>
                    </noscript>
                </span>
            </div>
        </div> --}}


        {{-- Support --}}
        <div class="my-8 md:my-12 lg:my-16 xl:my-20 3xl:my-24 pb-5 lg:pb-3.5 2xl:pb-5 pt-3 lg:pt-1.5 2xl:pt-2 3xl:pt-3 text-center">
            <div class="max-w-md mx-auto mb-4 md:mb-5 xl:mb-8 2xl:mb-10 3xl:mb-12">
                <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading mb-2 md:mb-3 lg:mb-3.5">
                    {{__('home.support_title')}}
                </h3>
                    <p class="text-body text-xs md:text-sm leading-6 md:leading-7">
                        {{__('home.support_blurb')}}
                    </p>
            </div>
            <div class="mb-2.5 md:mb-0 xl:mb-2 2xl:mb-4 3xl:mb-6 md:px-20 lg:px-40 xl:px-0">
                <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                <img style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27870%27%20height=%27300%27/%3e">
            </span>
                <img alt="Support Thumbnail" src="/assets/images/support/call-centre.webp" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%" srcset="/assets/images/support/call-centre.webp, /assets/images/support/call-centre.webp 2x">
                <noscript>
                    <img alt="Support Thumbnail" srcSet="/assets/images/support/call-centre.webp, /assets/images/support/call-centre.webp 2x" src="/assets/images/support/call-centre.webp" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
                </noscript>
            </span>
            </div>
            <button data-variant="flat" class="text-[13px] md:text-sm leading-4 inline-flex items-center cursor-pointer transition ease-in-out duration-300 font-semibold font-body text-center justify-center border-0 border-transparent placeholder-white focus-visible:outline-none focus:outline-none rounded-md  bg-heading text-white px-5 md:px-6 lg:px-8 py-4 md:py-3.5 lg:py-4 hover:text-white hover:bg-gray-600 hover:shadow-cart">
                Chat With Support Services
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="ms-2 text-lg md:text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M87.48 380c1.2-4.38-1.43-10.47-3.94-14.86a42.63 42.63 0 00-2.54-3.8 199.81 199.81 0 01-33-110C47.64 139.09 140.72 48 255.82 48 356.2 48 440 117.54 459.57 209.85a199 199 0 014.43 41.64c0 112.41-89.49 204.93-204.59 204.93-18.31 0-43-4.6-56.47-8.37s-26.92-8.77-30.39-10.11a31.14 31.14 0 00-11.13-2.07 30.7 30.7 0 00-12.08 2.43L81.5 462.78a15.92 15.92 0 01-4.66 1.22 9.61 9.61 0 01-9.58-9.74 15.85 15.85 0 01.6-3.29z">
                    </path>
                    <circle cx="160" cy="256" r="32">
                    </circle>
                    <circle cx="256" cy="256" r="32">
                    </circle>
                    <circle cx="352" cy="256" r="32">
                    </circle>
                </svg>
            </button>
        </div>

        {{-- Newsletter --}}
        <div class="px-8 sm:px-16 xl:px-0 flex flex-col xl:flex-row justify-center xl:justify-between items-center rounded-lg bg-gray-200 py-10 md:py-14 lg:py-16">
            <div class="lg:-mt-2 xl:-mt-0.5 text-center xl:text-start mb-7 md:mb-8 lg:mb-9 xl:mb-0">
                <h3 class="text-lg md:text-xl lg:text-2xl 2xl:text-3xl xl:leading-10 font-bold text-heading sm:mb-0 md:mb-2.5 lg:mb-3 xl:mb-3.5">
                    {{__('home.newsletter_title')}}
                </h3>
                <p class="text-body text-xs md:text-sm leading-6 md:leading-7">
                    {{__('home.newsletter_blurb')}}
                </p>
                </div>
            <form class="flex-shrink-0 w-full sm:w-96 md:w-[545px]" novalidate="">
                <div class="flex flex-col sm:flex-row items-start justify-end">
                    <div class="w-full">
                        <input id="subscription_email" name="subscription_email" type="email" placeholder="Write your email here" class="py-2 px-4 md:px-5 w-full appearance-none transition duration-150 ease-in-out border text-input text-xs lg:text-sm font-body placeholder-body min-h-12 transition duration-200 ease-in-out bg-white border-gray-300 focus:outline-none focus:border-heading h-11 md:h-12 px-4 lg:px-7 h-12 lg:h-14 text-center sm:text-start bg-white rounded-md" autocomplete="off" spellcheck="false" aria-invalid="false">
                    </div>
                    <button data-variant="flat" class="text-[13px] md:text-sm leading-4 inline-flex items-center cursor-pointer transition ease-in-out duration-300 font-semibold font-body text-center justify-center border-0 border-transparent placeholder-white focus-visible:outline-none focus:outline-none rounded-md  bg-heading text-white px-5 md:px-6 lg:px-8 py-4 md:py-3.5 lg:py-4 hover:text-white hover:bg-gray-600 hover:shadow-cart mt-3 sm:mt-0 w-full sm:w-auto sm:ms-2 md:h-full flex-shrink-0">
                        <span class="lg:py-0.5">Subscribe</span>
                    </button>
                </div>
            </form>
        </div>
        
</x-layout.layout>