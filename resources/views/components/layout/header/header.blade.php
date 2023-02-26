{{-- <header id="siteHeader" class="w-full h-16 sm:h-20 lg:h-24 relative z-20"> --}}
<header id="siteHeader" class="w-full h-16 sm:h-16 lg:h-16 relative z-20">
	<x-layout.header.top-menu />
	
	<div class="innerSticky text-gray-700 body-font fixed bg-white w-full h-12 sm:h-12 lg:h-12 z-20 ps-4 md:ps-0 lg:ps-3 pe-2 lg:pe-3 transition duration-200 ease-in-out">
		<div class="flex items-center justify-center mx-auto max-w-[1920px] h-full w-full">

			<button aria-label="Menu" class="menuBtn hidden md:flex lg:hidden flex-col items-center justify-center px-5 2xl:px-7 flex-shrink-0 h-full outline-none focus:outline-none" onClick={handleMobileMenu}
			>
				<span class="menuIcon">
					<span class="bar" />
					<span class="bar" />
					<span class="bar" />
				</span>
			</button>
			< x-ui.logo />
			<x-layout.header.header-menu class="hidden lg:flex md:ms-6 xl:ms-10" />
			
			<div class="hidden md:flex justify-end items-center space-s-6 lg:space-s-5 xl:space-s-8 2xl:space-s-10 ms-auto flex-shrink-0 mx-5">
				<button class="flex items-center justify-center flex-shrink-0 h-auto relative focus:outline-none transform" aria-label="search-button">
				<x-icons.search-icon />
			</button>
		</div>
	</div>
</div>
</header>