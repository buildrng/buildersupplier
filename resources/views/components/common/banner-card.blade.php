import Link from '@components/ui/link';
import Image from 'next/image';
import type { FC } from 'react';
import { useWindowSize } from '@utils/use-window-size';
import cn from 'classs';
import { LinkProps } from 'next/link';

interface BannerProps {
  banner: any;
  variant?: 'rounded' | 'default';
  effectActive?: boolean;
  class?: string;
  classInner?: string;
  href: LinkProps['href'];
}

function getImage(deviceWidth: number, imgObj: any) {
  return deviceWidth < 480 ? imgObj.mobile : imgObj.desktop;
}

const BannerCard: FC<BannerProps> = ({
  banner,
  class,
  variant = 'rounded',
  effectActive = false,
  classInner,
  href,
}) => {
  const { width } = useWindowSize();
  const { title, image } = banner;
  const selectedImage = getImage(width, image);
  return (
    <div class={cn('mx-auto', class)}>
      <Link
        href={href}
        class={cn(
          'h-full group flex justify-center relative overflow-hidden',
          classInner
        )}
      >
        <Image
          src={selectedImage.url}
          width={selectedImage.width}
          height={selectedImage.height}
          alt={title}
          quality={100}
          class={cn('bg-gray-300 object-cover w-full', {
            'rounded-md': variant === 'rounded',
          })}
        />
        {effectActive && (
          <div class="absolute top-0 -start-full h-full w-1/2 z-5 block transform -skew-x-12 bg-gradient-to-r from-transparent to-white opacity-40 group-hover:animate-shine" />
        )}
      </Link>
    </div>
  );
};

export default BannerCard;
