<div class="flex items-center justify-center mx-auto max-w-[1920px] h-full lg:h-20 xl:h-24 w-full relative before:absolute before:w-screen before:h-px before:bg-[#F1F1F1] before:bottom-0">
	<button aria-label="Menu"
		class="flex-col items-center justify-center flex-shrink-0 hidden h-full px-5 outline-none menuBtn md:flex lg:hidden 2xl:px-7 focus:outline-none">
		<span class="menuIcon">
			<span class="bar">
				</span>
			<span class="bar">
				</span>
			<span class="bar">
			</span>
			</span>
		</button>
	<div class="flex items-center 2xl:me-12 3xl:me-20">
		<a class="inline-flex focus:outline-none" href="/">
			<span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:95px;height:30px;background:none;opacity:1;border:0;margin:0;padding:0;position:relative">
				<img alt="{{config('app.name')}}" srcset="/assets/logo_color.png 1x, /assets/logo_color.png 2x" src="/assets/images/logo_color.png" decoding="async" data-nimg="fixed" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%">
			</span>
		</a>
		<div class="hidden transition-all duration-100 ease-in-out lg:flex ms-7 xl:ms-9 pe-2 headerTopMenu">
			<x-layout.header.topbar-nav />
		</div>
	</div>
	<div class="relative hidden w-2/6 me-auto lg:block">
		<x-layout.header.searchbar />
	</div>
	<div class="flex flex-shrink-0 transition-all duration-200 ease-in-out transform ms-auto me-3 lg:me-5 xl:me-8 2xl:me-10 languageSwitcher lg:hidden">
		<x-layout.header.mobile-languageswitcher />
	</div>
	<div class="flex items-center justify-end flex-shrink-0">
		<div class="items-center transition-all flex wishlistShopping space-s-7 lg:space-s-6 xl:space-s-8 2xl:space-s-10 ps-3">
			<x-layout.header.wishlist />
			<x-layout.header.shoppingcart />
		</div>
	</div>
</div>