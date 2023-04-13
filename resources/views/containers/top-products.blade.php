<div class="mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16">
    {{-- init section --}}
    {{-- section header --}}
    <div class="flex items-center justify-between -mt-2 lg:-mt-2.5 pb-0.5 mb-4 md:mb-5 lg:mb-6 2xl:mb-7 3xl:mb-8">
        Top Products <a href="/proucts" class="text-xs lg:text-sm xl:text-base text-heading mt-0.5 lg:mt-1">more</a>
        {{-- section products --}}
        <template product in home.homeProducts>
        <div class="row-span-full lg:row-span-2 col-span-full lg:col-span-2">
            <div class="flex flex-col md:flex-row lg:flex-col 2xl:flex-row md:justify-between md:items-center lg:items-start 2xl:items-center w-full px-4 md:px-5 3xl:px-7 pb-4 md:pb-5 3xl:pb-7"
        x-text="product.name">
        <div class="md:pe-2 lg:pe-0 2xl:pe-2 overflow-hidden">
          <h2 class="text-heading font-semibold text-sm md:text-base xl:text-lg mb-1 truncate">
            <span x-text="product.name"></span>
          </h2>
          <p class="text-body text-xs xl:text-sm leading-normal xl:leading-relaxed truncate max-w-[250px]">
        </p>
        <span x-text="product.description"></span>
        </div>
        <div class="flex-shrink-0 flex flex-row-reverse md:flex-col lg:flex-row-reverse 2xl:flex-col items-center md:items-end lg:items-start 2xl:items-end justify-end md:text-end lg:text-start xl:text-end mt-2 md:-mt-0.5 lg:mt-2 2xl:-mt-0.5">
          <span x-text="product.discount"></span>
            <del class="text-sm md:text-base lg:text-sm xl:text-base 3xl:text-lg">
                <span x-text="product.basePrice"></span>
            </del>
          )}
          <div class="text-heading font-segoe font-semibold text-base md:text-xl lg:text-base xl:text-xl 3xl:text-2xl 3xl:mt-0.5 pe-2 md:pe-0 lg:pe-2 2xl:pe-0">
            <span class="pprroduct.price"></span>
          </div>
        </div>
        </div>
    </div>

    <div class="grid grid-cols-4 grid-rows-2 gap-3 md:gap-5 xl:gap-7">

    </div>
</div>