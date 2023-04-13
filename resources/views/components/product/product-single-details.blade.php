import React, { useState } from "react";
import Button from "@components/ui/button";
import Counter from "@components/common/counter";
import { useRouter } from "next/router";
import { useProductQuery } from "@framework/product/get-product";
import { getVariations } from "@framework/utils/get-variations";
import usePrice from "@framework/product/use-price";
import { useCart } from "@contexts/cart/cart.context";
import { generateCartItem } from "@utils/generate-cart-item";
import { ProductAttributes } from "./product-attributes";
import isEmpty from "lodash/isEmpty";
import Link from "@components/ui/link";
import { toast } from "react-toastify";
import { useWindowSize } from "@utils/use-window-size";
import Carousel from "@components/ui/carousel/carousel";
import { SwiperSlide } from "swiper/react";
import ProductMetaReview from "@components/product/product-meta-review";

const productGalleryCarouselResponsive = {
	"768": {
		slidesPerView: 2,
	},
	"0": {
		slidesPerView: 1,
	},
};

const ProductSingleDetails: React.FC = () => {
	const {
		query: { slug },
	} = useRouter();
	const { width } = useWindowSize();
	const { data, isLoading } = useProductQuery(slug as string);
	const { addItemToCart } = useCart();
	const [attributes, setAttributes] = useState<{ [key: string]: string }>({});
	const [quantity, setQuantity] = useState(1);
	const [addToCartLoader, setAddToCartLoader] = useState<boolean>(false);
	const { price, basePrice, discount } = usePrice(
		data && {
			amount: data.sale_price ? data.sale_price : data.price,
			baseAmount: data.price,
			currencyCode: "USD",
		}
	);
	if (isLoading) return <p>Loading...</p>;
	const variations = getVariations(data?.variations);

	const isSelected = !isEmpty(variations)
		? !isEmpty(attributes) &&
		  Object.keys(variations).every((variation) =>
				attributes.hasOwnProperty(variation)
		  )
		: true;

	function addToCart() {
		if (!isSelected) return;
		// to show btn feedback while product carting
		setAddToCartLoader(true);
		setTimeout(() => {
			setAddToCartLoader(false);
		}, 600);

		const item = generateCartItem(data!, attributes);
		addItemToCart(item, quantity);
		toast("Added to the bag", {
			type: "dark",
			progressclass: "fancy-progress-bar",
			position: width > 768 ? "bottom-right" : "top-right",
			autoClose: 2000,
			hideProgressBar: false,
			closeOnClick: true,
			pauseOnHover: true,
			draggable: true,
		});
		console.log(item, "item");
	}

	function handleAttribute(attribute: any) {
		setAttributes((prev) => ({
			...prev,
			...attribute,
		}));
	}

	return (
		<div class="block lg:grid grid-cols-9 gap-x-10 xl:gap-x-14 pt-7 pb-10 lg:pb-14 2xl:pb-20 items-start">
			{width < 1025 ? (
				<Carousel
					pagination={{
						clickable: true,
					}}
					breakpoints={productGalleryCarouselResponsive}
					class="product-gallery"
					buttonclass="hidden"
				>
					{data?.gallery?.map((item, index: number) => (
						<SwiperSlide key={`product-gallery-key-${index}`}>
							<div class="col-span-1 transition duration-150 ease-in hover:opacity-90">
								<img
									src={
										item?.original ??
										"/assets/placeholder/products/product-gallery.svg"
									}
									alt={`${data?.name}--${index}`}
									class="object-cover w-full"
								/>
							</div>
						</SwiperSlide>
					))}
				</Carousel>
			) : (
				<div class="col-span-5 grid grid-cols-2 gap-2.5">
					{data?.gallery?.map((item, index: number) => (
						<div
							key={index}
							class="col-span-1 transition duration-150 ease-in hover:opacity-90"
						>
							<img
								src={
									item?.original ??
									"/assets/placeholder/products/product-gallery.svg"
								}
								alt={`${data?.name}--${index}`}
								class="object-cover w-full"
							/>
						</div>
					))}
				</div>
			)}

			<div class="col-span-4 pt-8 lg:pt-0">
				<div class="pb-7 mb-7 border-b border-gray-300">
					<h2 class="text-heading text-lg md:text-xl lg:text-2xl 2xl:text-3xl font-bold hover:text-black mb-3.5">
						{data?.name}
					</h2>
					<p class="text-body text-sm lg:text-base leading-6 lg:leading-8">
						{data?.description}
					</p>
					<div class="flex items-center mt-5">
						<div class="text-heading font-bold text-base md:text-xl lg:text-2xl 2xl:text-4xl pe-2 md:pe-0 lg:pe-2 2xl:pe-0">
							{price}
						</div>
						{discount && (
							<span class="line-through font-segoe text-gray-400 text-sm md:text-base lg:text-lg xl:text-xl ps-2">
								<span x-text=""product.original_price></span>
							</span>
						)}
					</div>
				</div>

				<div class="pb-3 border-b border-gray-300">
					{Object.keys(variations).map((variation) => {
						return (
							<ProductAttributes
								key={variation}
								title={variation}
								attributes={variations[variation]}
								active={attributes[variation]}
								onClick={handleAttribute}
							/>
						);
					})}
				</div>
				<div class="flex items-center space-s-4 md:pe-32 lg:pe-12 2xl:pe-32 3xl:pe-48 border-b border-gray-300 py-8">
					<Counter
						quantity={quantity}
						onIncrement={() => setQuantity((prev) => prev + 1)}
						onDecrement={() =>
							setQuantity((prev) => (prev !== 1 ? prev - 1 : 1))
						}
						disableDecrement={quantity === 1}
					/>
					<Button
						onClick={addToCart}
						variant="slim"
						class={`w-full md:w-6/12 xl:w-full ${
							!isSelected && "bg-gray-400 hover:bg-gray-400"
						}`}
						disabled={!isSelected}
						loading={addToCartLoader}
					>
						<span class="py-2 3xl:px-8">Add to cart</span>
					</Button>
				</div>
				<div class="py-6">
					<ul class="text-sm space-y-5 pb-1">
						<li>
							<span class="font-semibold text-heading inline-block pe-2">
								SKU:
							</span>
							{data?.sku}
						</li>
						<li>
							<span class="font-semibold text-heading inline-block pe-2">
								Category:
							</span>
							<Link
								href="/"
								class="transition hover:underline hover:text-heading"
							>
								{data?.category?.name}
							</Link>
						</li>
						{data?.tags && Array.isArray(data.tags) && (
							<li class="productTags">
								<span class="font-semibold text-heading inline-block pe-2">
									Tags:
								</span>
								{data.tags.map((tag) => (
									<Link
										key={tag.id}
										href={tag.slug}
										class="inline-block pe-1.5 transition hover:underline hover:text-heading last:pe-0"
									>
										{tag.name}
										<span class="text-heading">,</span>
									</Link>
								))}
							</li>
						)}
					</ul>
				</div>

				<ProductMetaReview data={data} />
			</div>
		</div>
	);
};

export default ProductSingleDetails;
