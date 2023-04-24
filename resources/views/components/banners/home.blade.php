<div class="banner relative mx-0">
    <template x-for="banner in home.banners">
        <a class="group relative flex justify-center" href="/">
            <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                    <img :src="'/assets/images/'+banner.cover" :alt="banner.message" style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0">
                </span>
            </span>
            <span class="absolute text-white text-5xl top-2/4" x-text="banner.message"></span>
        </a>
    </template>
    {{-- <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
        <span class="swiper-pagination-bullet">
            </span>
        <span class="swiper-pagination-bullet">
            </span>
        <span class="swiper-pagination-bullet swiper-pagination-bullet-active">
            </span>
    </div> --}}
</div>