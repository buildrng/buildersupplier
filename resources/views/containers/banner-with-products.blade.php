import BannerCard from "@components/common/banner-card";
import SectionHeader from "@components/common/section-header";
import ProductCard from "@components/product/product-card";
import ProductCardListSmallLoader from "@components/ui/loaders/product-card-small-list-loader";
import { useOnSellingProductsQuery } from "@framework/product/get-all-on-selling-products";
import { homeThreeProductsBanner as banner } from "@framework/static/banner";
import Alert from "@components/ui/alert";
import { ROUTES } from "@utils/routes";

interface ProductsProps {
	sectionHeading: string;
	categorySlug?: string;
	class?: string;
	variant?: "default" | "reverse";
}

const BannerWithProducts: React.FC<ProductsProps> = ({
	sectionHeading,
	categorySlug,
	variant = "default",
	class = "mb-12 md:mb-14 xl:mb-16",
}) => {
	const { data, isLoading, error } = useOnSellingProductsQuery({
		limit: 10,
	});

	return (
		<div class={class}>
			<SectionHeader
				sectionHeading={sectionHeading}
				categorySlug={categorySlug}
			/>
			{error ? (
				<Alert message={error?.message} />
			) : (
				<div class="grid grid-cols-4 gap-3 lg:gap-5 xl:gap-7">
					{variant === "reverse" ? (
						<BannerCard
							banner={banner[1]}
							href={`${ROUTES.COLLECTIONS}/${banner[1].slug}`}
							class="hidden 3xl:block"
							effectActive={true}
						/>
					) : (
						<BannerCard
							banner={banner[0]}
							href={`${ROUTES.COLLECTIONS}/${banner[0].slug}`}
							class="hidden 3xl:block"
							effectActive={true}
						/>
					)}
					<div
						class={`col-span-full 3xl:col-span-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3 md:gap-5 xl:gap-7 ${
							variant === "reverse" ? "row-span-full" : ""
						}`}
					>
						{isLoading
							? Array.from({ length: 9 }).map((_, idx) => (
									<ProductCardListSmallLoader
										key={idx}
										uniqueKey={`on-selling-${idx}`}
									/>
							  ))
							: data?.map((product) => (
									<ProductCard
										key={`product--key${product.id}`}
										product={product}
										imgWidth={176}
										imgHeight={176}
										variant="listSmall"
									/>
							  ))}
					</div>
				</div>
			)}
		</div>
	);
};

export default BannerWithProducts;
