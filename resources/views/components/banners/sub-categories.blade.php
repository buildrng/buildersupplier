<div class="subcategories col-span-full lg:col-span-2 grid grid-cols-1 gap-2 justify-between" x-data="{subcategories :  null}" x-init="home.then((value) => {subcategories = value.data.data.category; console.log(subcategories);})">
<template x-for="subcategory in subcategories">
        <a :href="'/categories/'+subcategory.slug" class="flex justify-between items-center bg-gray-200 rounded-md px-5 2xl:px-3.5 py-3 xl:py-3.5 2xl:py-2.5 3xl:py-3.5 transition hover:bg-gray-100">
			<div class="inline-flex flex-shrink-0 2xl:w-12 2xl:h-12 3xl:w-auto 3xl:h-auto">
				<span  class="text-xs 2xl:text-sm 3xl:text-base text-heading capitalize ps-2.5 md:ps-4 2xl:ps-3 3xl:ps-4" x-text="subcategory.name"></span>
			</div>
        </a>
    </template>
	<a href="/categories" class="flex justify-between items-center bg-gray-200 rounded-md px-5 2xl:px-3.5 py-3 xl:py-3.5 2xl:py-2.5 3xl:py-3.5 transition hover:bg-gray-100">
		<div class="inline-flex flex-shrink-0 2xl:w-12 2xl:h-12 3xl:w-auto 3xl:h-auto">
			<span  class="text-xs 2xl:text-sm 3xl:text-base text-heading ps-2.5 md:ps-4 2xl:ps-3 3xl:ps-4">...more</span>
		</div>
	</a>
</div>