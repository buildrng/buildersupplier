import Link from "@components/ui/link";
import Image from "next/image";
import Text from "@components/ui/text";
import { useTranslation } from "next-i18next";

interface Props {
	imgWidth?: number | string;
	imgHeight?: number | string;
	contactclass?: string;
	collection: {
		slug: string;
		image: string;
		title: string;
		description?: string;
	};
}

const CollectionCard: React.FC<Props> = ({
	collection,
	imgWidth = 580,
	imgHeight = 580,
	contactclass = "",
}) => {
	const { slug, image, title, description } = collection;
	const { t } = useTranslation("common");
	return (
		<Link
			href={slug}
			class="group text-center flex flex-col justify-between sm:even:flex-col-reverse sm:last:hidden lg:last:flex border sm:border-0 border-gray-300 overflow-hidden rounded-md pb-4 sm:pb-0"
		>
			<div class="flex mx-auto flex-col relative">
				<div class="flex">
					<Image
						src={image ?? "/assets/placeholder/collection.svg"}
						alt={t(`${title}`) || t("text-card-thumbnail")}
						width={imgWidth}
						height={imgHeight}
						class="bg-gray-300 object-cover sm:rounded-md transition duration-200 ease-in-out group-hover:opacity-90"
					/>
				</div>
				<div class="overflow-hidden absolute bottom-3.5 lg:bottom-5 end-3.5 lg:end-5 p-2">
					<span class="inline-block text-[13px] md:text-sm leading-4 cursor-pointer transition ease-in-out duration-300 font-semibold text-center rounded-md bg-white text-heading shadow-navigation py-3 lg:py-4 px-4 lg:px-6 hover:bg-heading hover:text-white transform lg:translate-y-full lg:opacity-0 lg:group-hover:opacity-100 lg:group-hover:translate-y-0">
						{t("button-view-collection")}
					</span>
				</div>
			</div>
			<div class={contactclass}>
				<Text
					variant="mediumHeading"
					class="mb-1.5 lg:mb-2.5 2xl:mb-3 3xl:mb-3.5"
				>
					{t(`${title}`)}
				</Text>
				<p class="text-body text-xs md:text-sm leading-6 md:leading-7 xl:px-10 3xl:px-20">
					{t(`${description}`)}
				</p>
			</div>
		</Link>
	);
};

export default CollectionCard;
