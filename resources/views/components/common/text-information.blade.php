import classs from "classs";
import Image from "next/image";
import { useTranslation } from "next-i18next";

interface ItemProps {
	icon: string;
	title: string;
	description: string;
}

interface Props {
	class?: string;
	item: ItemProps;
}

const TextInformation: React.FC<Props> = ({ item, class }) => {
	const { t } = useTranslation("common");
	return (
		<div
			class={classs(
				`text-center border-gray-300 xl:border-l xl:first:border-s-0 px-4 sm:px-2.5 2xl:px-8 3xl:px-12 xl:py-12`,
				class
			)}
		>
			<div class="mb-3.5 md:mb-5 xl:mb-3.5 2xl:mb-5 w-14 md:w-auto mx-auto">
				<Image
					src={item.icon}
					alt={t(`${item.title}`)}
					width="78"
					height="78"
				/>
			</div>
			<div class="-mb-1">
				<h3 class="text-heading text-base md:text-lg font-semibold mb-1.5 md:mb-2">
					{t(`${item.title}`)}
				</h3>
				<p class="text-body text-xs md:text-sm leading-6 md:leading-7">
					{t(`${item.description}`)}
				</p>
			</div>
		</div>
	);
};

export default TextInformation;
