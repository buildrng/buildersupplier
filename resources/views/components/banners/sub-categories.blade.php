<div class="subcategories col-span-full lg:col-span-2 grid grid-cols-1 gap-3 justify-between">
    <template x-for="subcategory in categories">
        <a :href="'/categories/'+subcategory.slug" class="flex justify-between items-center bg-gray-200 rounded-md px-5 2xl:px-3.5 py-3 xl:py-3.5 2xl:py-2.5 3xl:py-3.5 transition hover:bg-gray-100">
        <div class="flex items-center">
					<div class="inline-flex flex-shrink-0 2xl:w-12 2xl:h-12 3xl:w-auto 3xl:h-auto">
						<span  class="text-sx md:text-base 2xl:text-sm 3xl:text-base text-heading capitalize ps-2.5 md:ps-4 2xl:ps-3 3xl:ps-4" x-text="subcategory.name"></span>
				</div>
                {{-- <div class="flex items-center">
					<div class="text-xs font-medium w-5 h-5 flex flex-shrink-0 justify-center items-center bg-gray-350 rounded 2xl:me-2">
						<span x-text="productCount"></span>
					</div>
					<IoIosArrowForward class="hidden 2xl:block text-sm text-heading" /> --}}
				</div>
        </a>
    </template>
</div>