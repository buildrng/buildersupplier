<div class="banner col-span-full lg:col-span-5 xl:col-span-5 row-span-full lg:row-auto grid grid-cols-2 gap-2 md:gap-3.5 lg:gap-5 xl:gap-7">
    <template x-for="banner in banners">
        <a :href="'/'+banner.link" class="flex  text-white text-2xl text-center">
            <img :src="banner.cover" :alt="banner.message" class="absolute top-0 -z-10" />
            <p class="" x-text="banner.message"></p>
        </a>
    </template>
</div>