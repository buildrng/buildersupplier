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
	@vite(['resources/css/app.css'])
    <script src="/assets/js/layout.js" defer></script>
	<script src="/assets/js/alpinejs@3.12.0.min.js" defer></script>
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
                    <div class="menuItem group cursor-pointer py-7 relative">
                        <div x-init="categories = get('category/getHome/', this.categories)">
                            {{-- <div x-data="console.log(categories)"></div> --}}
                            <template x-for="category in await categories">
                                <a class="relative inline-flex items-center px-3 py-2 text-sm font-normal xl:text-base text-heading xl:px-4 group-hover:text-black"
                                :href="'/categories/'+category.slug">
                                <span x-text="category.name"></span>
                            </a>
                        </template>
                    </div>
                    {{-- <a class="relative inline-flex items-center px-3 py-2 text-sm font-normal xl:text-base text-heading xl:px-4 group-hover:text-black"
                    href="/">Pages<span class="opacity-30 text-xs mt-1 xl:mt-0.5 w-4 flex justify-end">
                        <svg
                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512"
                        class="transition duration-300 ease-in-out transform group-hover:-rotate-180" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                    </path>
                </svg>
            </span>
        </a> --}}
        {{-- <div class="absolute invisible bg-gray-200 opacity-0 group-hover:visible subMenu shadow-header start-0 group-hover:opacity-100">
            <ul class="py-5 text-sm text-body">
                <li class="group relative">
                    <a class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                    href="/">Users
                    <span class="text-sm mt-0.5 shrink-0 ml-auto">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="transition duration-300 ease-in-out text-body group-hover:text-black" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
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
                    <li class="group relative">
                        <a
                        class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                        href="/signin">Sign In</a>
                    </li>
                    <li class="group relative">
                        <a
                        class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                        href="/signup">Sign Up</a>
                    </li>
                    <li class="group relative">
                        <a
                        class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                        href="/forget-password">Forget Password</a>
                    </li>
                </ul>
            </li>
            <li class="group relative">
                <a
                class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                href="/faq">FAQ</a>
            </li>
            <li class="group relative">
                <a
                class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                href="/privacy">Privacy Policy</a>
            </li>
            <li class="group relative">
                <a
                    class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                    href="/terms">Terms &amp; Condition</a>
                </li>
                <li class="group relative">
                    <a
                    class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                    href="/contact-us">Contact Us</a>
                </li>
                <li class="group relative">
                    <a
                    class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                    href="/checkout">Checkout</a>
                </li>
                <li class="group relative">
                    <a
                    class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                    href="/collections/mens-collection">Collection</a>
                </li>
                <li class="group relative">
                <a
                class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                href="/category/man">Category</a>
            </li>
            <li class="group relative">
                <a
                class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                href="/order">Order</a>
            </li>
            <li class="group relative">
                <a
                class="flex items-center py-2 ps-5 xl:ps-7 pe-3 xl:pe-3.5 hover:text-heading hover:bg-gray-300"
                href="/404">404</a>
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
<footer>
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