<div class="group box-border overflow-hidden flex rounded-md cursor-pointer pe-0 md:pb-1 flex-col items-start bg-white" {{-- onClick={handlePopupView} --}} role="button">
			<div class="flex mb-3 md:mb-3.5 pb-0">
				<img :src="'assets/images/'+ product.images" width=340 height=440 loading=eager :alt="product.name" class="unded-s-md rounded-md transition duration-150 ease-linear transform group-hover:scale-105" />
			</div>
			<div class="w-full overflow-hidden ps-0">
				<div class="flex flex-col justify-around">
						{{-- <a :href="'/product/'+product.slug" x-text="product.name" class="text-heading font-semibold truncate mb-1 md:mb-1.5 text-sm sm:text-base md:text-sm lg:text-base xl:text-lg"></a> --}}
						<a :href="'/product/'+product.slug" x-text="product.name" class="text-heading font-semibold truncate text-sm sm:text-base md:text-sm lg:text-base xl:text-lg"></a>

					{{-- <div class="text-heading font-semibold text-sm mt-1.5 space-s-2 sm:text-xl md:text-base lg:text-xl md:mt-2.5 2xl:mt-3"> --}}
					{{-- <div class="text-heading font-semibold text-sm mt-0 space-s-2 sm:text-xl md:text-base lg:text-xl">
						<span class="inline-block" x-text="product.sell_price"></span>
							<del class="sm:text-base font-normal text-gray-800">
								<span x-text="product.original_price"></span>
							</del>
					</div> --}}
				</div>
				<div class="grid grid-flow-col gap-1 text-white">
					<button class="bg-green-500 rounded-sm p-1">Add to Cart</button>
					<button class="bg-green-900 rounded-sm">Buy Now</button>
				</div>
				
			</div>
</div>
