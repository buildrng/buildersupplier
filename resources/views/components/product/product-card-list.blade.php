
		<div
			class={cn(
				"group box-border overflow-hidden flex rounded-md cursor-pointer",
				{
					"pe-0 pb-2 lg:pb-3 flex-col items-start bg-white transition duration-200 ease-in-out transform hover:-translate-y-1 hover:md:-translate-y-1.5 hover:shadow-product":
						variant === "grid",
					"pe-0 md:pb-1 flex-col items-start bg-white": variant === "gridSlim",
					"items-center bg-transparent border border-gray-100 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:shadow-listProduct":
						variant === "listSmall",
					"flex-row items-center transition-transform ease-linear bg-gray-200 pe-2 lg:pe-3 2xl:pe-4":
						variant === "list",
				},
				class
			)}
			onClick={handlePopupView}
			role="button"
			title=<span x-text="product.name"></span>
		>
			<div
				class={cn(
					"flex",
					{
						"mb-3 md:mb-3.5": variant === "grid",
						"mb-3 md:mb-3.5 pb-0": variant === "gridSlim",
						"flex-shrink-0 w-32 sm:w-44 md:w-36 lg:w-44":
							variant === "listSmall",
					},
					imageContentclass
				)}
			>
				<Image
					:src="product.image"
					width="340px"
					height="440px"
					loading=eager
					
					x-alt="product.name
					class={cn("bg-gray-300 object-cover rounded-s-md", {
						"w-full rounded-md transition duration-200 ease-in group-hover:rounded-b-none":
							variant === "grid",
						"rounded-md transition duration-150 ease-linear transform group-hover:scale-105":
							variant === "gridSlim",
						"rounded-s-md transition duration-200 ease-linear transform group-hover:scale-105":
							variant === "list",
					})}
				/>
			</div>
			<div
				class={cn(
					"w-full overflow-hidden",
					{
						"ps-0 lg:ps-2.5 xl:ps-4 pe-2.5 xl:pe-4": variant === "grid",
						"ps-0": variant === "gridSlim",
						"px-4 lg:px-5 2xl:px-4": variant === "listSmall",
					},
					contactclass
				)}
			>
				<h2
					class={cn("text-heading font-semibold truncate mb-1", {
						"text-sm md:text-base": variant === "grid",
						"md:mb-1.5 text-sm sm:text-base md:text-sm lg:text-base xl:text-lg":
							variant === "gridSlim",
						"text-sm sm:text-base md:mb-1.5 pb-0": variant === "listSmall",
						"text-sm sm:text-base md:text-sm lg:text-base xl:text-lg md:mb-1.5":
							variant === "list",
					})}
				>
					<span x-text="product.name"></span>
				</h2>
				{product?.description && (
					<p class="text-body text-xs lg:text-sm leading-normal xl:leading-relaxed max-w-[250px] truncate">
						<span x-text="product.description"></span>
					</p>
				)}
				<div
					class={`text-heading font-semibold text-sm sm:text-base mt-1.5 space-s-2 ${
						variant === "grid"
							? "lg:text-lg lg:mt-2.5"
							: "sm:text-xl md:text-base lg:text-xl md:mt-2.5 2xl:mt-3"
					}`}
				>
					<span class="inline-block" x-text=""product.selling_price></span>
					{discount && (
						<del class="sm:text-base font-normal text-gray-800">
							<span x-text=""product.original_price></span>
						</del>
					)}
				</div>
			</div>
		</div>

