<nav x-data="{ categories: []}" x-init="axios('/category/getHome').then((response) => {categories = response.data.data})" class="headerMenu flex w-full relative justify-end">
	{{-- <div class="menuItem group cursor-pointer py-2"> --}}
	<template x-for="category in categories">
		<div class="menuItem group cursor-pointer">
			<a :href="'/categories/'+category.slug"
				class="inline-flex items-end text-sm xl:text-base text-heading px-3 xl:px-4 font-normal relative group-hover:text-black">
				<span x-text="category.name"></span>
			</a>
		</div>
	</template>
</nav>