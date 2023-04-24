<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="shop, store, ecommerce, e-commerce, Building, Materials, Building Materials, demand, constuction.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="David Nnachi">
	<meta name="description" content="Builder Supplier - your one stop shop for building materials on demand.">
	<title>{{ $title ?? 'Builder Supplier' }}</title>
	<link rel="canonical" href="https://'+{{env('APP_URL')}}+'/'" />
	<meta name="keywords" content="construction, Building, Materials">
	@vite('resources/css/app.css')
    <script src="/assets/js/layout.js"></script>
	<script defer src="/assets/js/alpinejs@3.12.0.min.js"></script>
</head>
<body class="flex flex-col min-h-screen" style="-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-text-size-adjust:100%;-moz-text-size-adjust:100%;text-size-adjust:100%">
	<header id="siteHeader" class="relative z-20 w-full h-16 sm:h-20 lg:h-36 xl:h-40 headerThree">
        <div class="fixed z-20 w-full h-16 text-gray-700 transition duration-200 ease-in-out bg-white innerSticky body-font sm:h-20 lg:h-36 xl:h-40 ps-4 md:ps-0 lg:ps-6 pe-4 lg:pe-6 px-4 md:px-8 2xl:px-16">
            <x-layout.header.top-menu />
            <div class="items-center hidden lg:flex lg:h-16 headerBottom mx-auto max-w-[1920px]">
                <div class="flex items-center">
                    <x-layout.header.allcategories-menu />
				</div>
				<nav class="headerMenu flex w-full relative lg:flex ps-3.5 xl:ps-5">
                    <div class="menuItem group cursor-pointer py-7 relative" x-data="{ Menu: []}" x-init="fetch('/api/v1/category/getHome/', { method: 'get', headers: {'Accept': 'application/json','Content-Type': 'application/json'}}).then((response) => response.json()).then((response) => Menu = response.data).catch((err) => console.log(err))">
                            <template x-for="category in Menu.category">
                                <a class="relative inline-flex items-center px-3 py-2 text-sm font-normal xl:text-base text-heading xl:px-4" :href="'/category/'+category.slug">
                                    <span x-text="category.name"></span>
                                </a>
                            </template>
                            {{-- <a class="relative inline-flex items-center px-3 py-2 text-sm font-normal xl:text-base text-heading xl:px-4 group-hover:text-white" href="/">
                                Pages
                                <span class="opacity-30 text-xs mt-1 xl:mt-0.5 w-4 flex justify-end">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="transition duration-300 ease-in-out transform group-hover:-rotate-180" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"></path>
                                    </svg></span>
                </a> --}}
        {{-- <div class="absolute invisible bg-gray-200 opacity-0 group-hover:visible subMenu shadow-header start-0 group-hover:opacity-100">
            <ul class="py-5 text-sm text-body">
                <li class="group relative">
                    <a class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                    href="/">Users
                    <span class="text-sm mt-0.5 shrink-0 ml-auto">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="transition duration-300 ease-in-out text-body group-hover:text-white" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M294.1 256L167 129c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.3 34 0L345 239c9.1 9.1 9.3 23.7.7 33.1L201.1 417c-4.7 4.7-10.9 7-17 7s-12.3-2.3-17-7c-9.4-9.4-9.4-24.6 0-33.9l127-127.1z">
                            </path>
                        </svg>
                    </span>
                </a>
                <ul class="absolute z-0 invisible w-56 py-3 bg-gray-200 opacity-0 subMenuChild shadow-subMenu end-full 2xl:end-auto 2xl:start-full top-4">
                    <li class="group relative">
                        <a
                        class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                        href="/my-account">My Account</a>
                    </li>
                </ul>
            </li>
            <li class="group relative">
                <a class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                href="/faq">FAQ</a>
            </li>
        </ul>
    </div> --}}
</div>
</nav>
</div>
<div class="flex items-center flex-shrink-0 ms-auto gap-x-7">
    <x-layout.header.auth-menu />
    <x-layout.header.languagepicker-menu />
</div>
</div>
</div>
</header>
<main class="relative flex-grow" style="min-height: -webkit-fill-available; -webkit-overflow-scrolling: touch">
    {{$slot}}
</main>
{{-- <footer class="border-b-4 border-heading mt-9 md:mt-11 lg:mt-16 3xl:mt-40 pt-4.5 lg:pt-4 2xl:pt-4"> --}}
<footer class="border-b-4 border-heading mt-9 md:mt-11 lg:mt-16 3xl:mt-40 pt-18 lg:pt-16 2xl:pt-16 bg-black">
    <div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-9 xl:gap-5  pb-9 md:pb-14 lg:pb-16 2xl:pb-20 3xl:pb-24 lg:mb-0.5 2xl:mb-0 3xl:-mb-1 xl:grid-cols-6">
        <div class="pb-3 md:pb-0 undefined">
        <h4 class="text-white text-sm md:text-base xl:text-lg font-semibold mb-5 2xl:mb-6 3xl:mb-7">Social</h4>
        <ul class="text-xs lg:text-sm text-white flex flex-col space-y-3 lg:space-y-3.5">
            <li class="flex items-baseline">
                <span class="me-3 relative top-0.5 lg:top-1 text-sm lg:text-base">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M349.33 69.33a93.62 93.62 0 0193.34 93.34v186.66a93.62 93.62 0 01-93.34 93.34H162.67a93.62 93.62 0 01-93.34-93.34V162.67a93.62 93.62 0 0193.34-93.34h186.66m0-37.33H162.67C90.8 32 32 90.8 32 162.67v186.66C32 421.2 90.8 480 162.67 480h186.66C421.2 480 480 421.2 480 349.33V162.67C480 90.8 421.2 32 349.33 32z">
                        </path>
                        <path d="M377.33 162.67a28 28 0 1128-28 27.94 27.94 0 01-28 28zM256 181.33A74.67 74.67 0 11181.33 256 74.75 74.75 0 01256 181.33m0-37.33a112 112 0 10112 112 112 112 0 00-112-112z">
                        </path>
                    </svg>
                </span>
                <a class="transition-colors duration-200 hover:text-white" href="https://www.instagram.com/buildersuppler/">Instagram</a>
            </li>
            <li class="flex items-baseline">
                <span class="me-3 relative top-0.5 lg:top-1 text-sm lg:text-base">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M496 109.5a201.8 201.8 0 01-56.55 15.3 97.51 97.51 0 0043.33-53.6 197.74 197.74 0 01-62.56 23.5A99.14 99.14 0 00348.31 64c-54.42 0-98.46 43.4-98.46 96.9a93.21 93.21 0 002.54 22.1 280.7 280.7 0 01-203-101.3A95.69 95.69 0 0036 130.4c0 33.6 17.53 63.3 44 80.7A97.5 97.5 0 0135.22 199v1.2c0 47 34 86.1 79 95a100.76 100.76 0 01-25.94 3.4 94.38 94.38 0 01-18.51-1.8c12.51 38.5 48.92 66.5 92.05 67.3A199.59 199.59 0 0139.5 405.6a203 203 0 01-23.5-1.4A278.68 278.68 0 00166.74 448c181.36 0 280.44-147.7 280.44-275.8 0-4.2-.11-8.4-.31-12.5A198.48 198.48 0 00496 109.5z">
                        </path>
                    </svg>
                </span>
                <a class="transition-colors duration-200 hover:text-white" href="https://twitter.com/buildersuppler">Twitter</a>
            </li>
            <li class="flex items-baseline">
                <span class="me-3 relative top-0.5 lg:top-1 text-sm lg:text-base">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221V208c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42h62.12l-9.92 64.77H291v156.54c107.1-16.81 189-109.48 189-221.31z">
                        </path>
                        </svg>
                    </span>
                    <a class="transition-colors duration-200 hover:text-white" href="https://www.facebook.com/buildersuppler/">Facebook</a>
            </li>
            <li class="flex items-baseline">
                <span class="me-3 relative top-0.5 lg:top-1 text-sm lg:text-base">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M508.64 148.79c0-45-33.1-81.2-74-81.2C379.24 65 322.74 64 265 64h-18c-57.6 0-114.2 1-169.6 3.6C36.6 67.6 3.5 104 3.5 149 1 184.59-.06 220.19 0 255.79q-.15 53.4 3.4 106.9c0 45 33.1 81.5 73.9 81.5 58.2 2.7 117.9 3.9 178.6 3.8q91.2.3 178.6-3.8c40.9 0 74-36.5 74-81.5 2.4-35.7 3.5-71.3 3.4-107q.34-53.4-3.26-106.9zM207 353.89v-196.5l145 98.2z">
                        </path>
                    </svg>
                </span>
                <a class="transition-colors duration-200 hover:text-white" href="https://www.youtube.com/channel/buildingsupplierng">Youtube</a>
            </li>
        </ul>
    </div>
    
    <div class="pb-3 md:pb-0 undefined">
            <h4 class="text-white text-sm md:text-base xl:text-lg font-semibold mb-5 2xl:mb-6 3xl:mb-7">Contact</h4>
            <ul class="text-xs lg:text-sm text-white flex flex-col space-y-3 lg:space-y-3.5">
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="/contact-us">Contact Us</a>
                </li>
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="shopnow@buildersupplier.ng">shopnow@buildersupplier.ng</a>
                </li>
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="contactus@buildersupplier.ngcontactus@buildersupplier.ng">contactus@buildersupplier.ng</a>
                </li>
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="/">Whatsapp: +234 816 663-4797</a>
                </li>
            </ul>
        </div>
        <div class="pb-3 md:pb-0 undefined">
            <h4 class="text-white text-sm md:text-base xl:text-lg font-semibold mb-5 2xl:mb-6 3xl:mb-7">About</h4>
            <ul class="text-xs lg:text-sm text-white flex flex-col space-y-3 lg:space-y-3.5">
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="/contact-us">Support Center</a>
                </li>
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="/">Customer Support</a>
                </li>
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="/contact-us">About Us</a>
                </li>
                <li class="flex items-baseline">
                    <a class="transition-colors duration-200 hover:text-white" href="/">Copyright</a>
                </li>
            </ul>
        </div>
                <div class="pb-3 md:pb-0 undefined">
                    <h4 class="text-white text-sm md:text-base xl:text-lg font-semibold mb-5 2xl:mb-6 3xl:mb-7">Customer Care</h4>
                    <ul class="text-xs lg:text-sm text-white flex flex-col space-y-3 lg:space-y-3.5">
                        <li class="flex items-baseline">
                            <a class="transition-colors duration-200 hover:text-white" href="/pages/faq">FAQ &amp; Helps</a>
                        </li>
                        <li class="flex items-baseline">
                            <a class="transition-colors duration-200 hover:text-white" href="/pages/shipping">Shipping &amp; Delivery</a>
                        </li>
                        <li class="flex items-baseline">
                            <a class="transition-colors duration-200 hover:text-white" href="/pages/returns">Return &amp; Exchanges</a>
                        </li>
                        <li class="flex items-baseline">
                            <a class="transition-colors duration-200 hover:text-white" href="/pages/terms">Terms &amp; conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-300 pt-5 pb-16 sm:pb-20 md:pb-5 mb-2 sm:mb-0 bg-gray-200">
            <div class="flex flex-col-reverse md:flex-row text-center md:justify-between mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
                <p class="text-body text-xs lg:text-sm leading-6">Copyright<!-- --> © <!-- -->2023<!-- -->&nbsp;<a class="font-semibold text-gray-700 transition-colors duration-200 ease-in-out hover:text-body" href="https://buildersupplier.ng">Builder Supplier</a>&nbsp; <!-- -->All rights reserved</p>
                <ul class="hidden md:flex flex-wrap justify-center items-center space-s-4 xs:space-s-5 lg:space-s-7 mb-1 md:mb-0 mx-auto md:mx-0">
                    <li class="mb-2 md:mb-0 transition hover:opacity-80">
                        <a href="/" target="_blank">
                            <img src="/assets/images/footer/payment/mastercard.svg" alt="Master Card" width="34" height="20">
                        </a>
                    </li>
                    <li class="mb-2 md:mb-0 transition hover:opacity-80">
                        <a href="/" target="_blank">
                            <img src="/assets/images/footer/payment/visa.svg" alt="Visa" width="50" height="20">
                        </a>
                    </li>
                    <li class="mb-2 md:mb-0 transition hover:opacity-80">
                        <a href="/" target="_blank">
                            <img src="/assets/images/footer/payment/jcb.svg" alt="JCB" width="26" height="20">
                        </a>
                    </li>
                    <li class="mb-2 md:mb-0 transition hover:opacity-80">
                        <a href="/" target="_blank">
                        <img src="/assets/images/footer/payment/skrill.svg" alt="Skrill" width="39" height="20">
                        </a>
                    </li>
                </ul>
        </div>
    </div>
</footer>
{{-- <MobileNavigati on /> --}}
{{-- <Search /> --}}
{{-- <CookieBar
    title={t("text-cookies-title")}
    hide={acceptedCookies}
    action={
        <Button variant="slim">
            text-accept-cookies
        </Button>
    } --}}
</body>
</html>