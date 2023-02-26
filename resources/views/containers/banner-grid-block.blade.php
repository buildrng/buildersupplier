import BannerCard from "@components/common/banner-card";
import Carousel from "@components/ui/carousel/carousel";
import { SwiperSlide } from "swiper/react";
import { bannerGrid } from "@framework/static/banner";
import { useWindowSize } from "@utils/use-window-size";
import { ROUTES } from "@utils/routes";

const breakpoints = {
	"1025": {
		slidesPerView: 3,
		spaceBetween: 28,
	},
	"480": {
		slidesPerView: 2,
		spaceBetween: 20,
	},
	"0": {
		slidesPerView: 1,
		spaceBetween: 12,
	},
};

interface BannerProps {
	class?: string;
}

const BannerGridBlock: React.FC<BannerProps> = ({
	class = "mb-12 lg:mb-14 xl:mb-16 lg:pb-1 xl:pb-0",
}) => {
	const { width } = useWindowSize();
	return (
		<div class={`${class}`}>
			{width < 768 ? (
				<div>
					<Carousel breakpoints={breakpoints}>
						{bannerGrid?.map((banner: any) => (
							<SwiperSlide key={`banner--key${banner.id}`}>
								<BannerCard
									banner={banner}
									href={`${ROUTES.COLLECTIONS}/${banner.slug}`}
									class="h-full"
								/>
							</SwiperSlide>
						))}
					</Carousel>
				</div>
			) : (
				<div class="md:grid md:grid-cols-2 md:gap-5 xl:gap-7 relative">
					{bannerGrid.map((banner: any) => (
						<BannerCard
							key={`banner--key${banner.id}`}
							banner={banner}
							href={`${ROUTES.COLLECTIONS}/${banner.slug}`}
							class={banner.type === "large" ? "col-span-2" : "col-span-1"}
						/>
					))}
				</div>
			)}
		</div>
	);
};

export default BannerGridBlock;
