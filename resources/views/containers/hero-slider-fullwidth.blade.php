import BannerCard from '@components/common/banner-card';
import Carousel from '@components/ui/carousel/carousel';
import { homeSixHeroImages as banners } from '@framework/static/banner';
import { ROUTES } from '@utils/routes';
import { SwiperSlide } from 'swiper/react';

const HeroSlider: React.FC = () => {
  return (
    <div class="relative mb-5 md:mb-8">
      <Carousel
        autoplay={false}
        class="mx-0"
        buttonclass="hidden"
        paginationPosition="left"
        pagination={{
          clickable: true,
        }}
      >
        {banners?.map((banner: any) => (
          <SwiperSlide
            class="carouselItem"
            key={`banner--key-${banner?.id}`}
          >
            <BannerCard
              banner={banner}
              href={`${ROUTES.COLLECTIONS}/${banner.slug}`}
            />
          </SwiperSlide>
        ))}
      </Carousel>
    </div>
  );
};

export default HeroSlider;
