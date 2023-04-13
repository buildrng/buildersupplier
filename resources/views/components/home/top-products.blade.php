<div class="mb-12 md:mb-14 xl:mb-16 border border-gray-300 rounded-md pt-5 md:pt-6 lg:pt-7 pb-5 lg:pb-7 px-4 md:px-5 lg:px-7" x-data="{products :  null}" x-init="home.then((value) => {products = value.data.data.topProducts; console.log(products);})">
    <div class="flex justify-between items-center flex-wrap mb-5 md:mb-6" id="top-products">Top Products</div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-x-3 md:gap-x-5 xl:gap-x-7 gap-y-4 lg:gap-y-5 xl:lg:gap-y-6 2xl:gap-y-8">
    <template x-for="product in products">
            <x-product.product-card />
    </template>
    </div>
</div>