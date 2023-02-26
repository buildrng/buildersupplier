<div x-data="{ languages: []}" x-init="axios('/languages/getLanguages').then((response) => {languages = response.data.data})" class="relative ms-2 lg:ms-0 z-10 w-[100px] sm:w-[100px] lg:w-[100px] xl:w-[100px]">
	<select class="w-full p-1 overflow-auto bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none text-xs mb-1">
		<template x-for="language in languages">
		<option class="'text-amber-900 bg-gray-100' : 'text-gray-900'" class="cursor-pointer select-none relative py-1 px-3" x-value="language.abbr">
			<span class="flex items-center" x-text="language.name"></span>
		</option>
		</template>
	</select>
</div>