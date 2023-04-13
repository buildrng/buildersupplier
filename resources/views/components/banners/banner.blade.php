<div class="" x-data="{banners :  null}" x-init="home.then((value) => {banners = value.data.data.banners; console.log(banners);})">
    <template x-for="banner in banners">
        <a :href="'/'+banner.link" class="col-span-full text-center text-white  text-2xl">
            <img :src="banner.cover" :alt="banner.message" width="806px" class="absolute top-0 -z-10" />
            <p class="mt-32" x-text="banner.message"></p>
        </a>
    </template>
</div>