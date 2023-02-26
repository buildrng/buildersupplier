import Link from "@components/ui/link";
import Image from "next/image";
import Text from "@components/ui/text";
import { FaLink } from "react-icons/fa";
import { LinkProps } from "next/link";
import { useTranslation } from "next-i18next";

interface Props {
	item: any;
	variant?: "rounded" | "circle";
	size?: "small" | "medium";
	effectActive?: boolean;
	href: LinkProps["href"];
}

const Card: React.FC<Props> = ({
	item,
	variant = "circle",
	size = "small",
	effectActive = false,
	href,
}) => {
	const { name, image } = item ?? {};
	const imageSize: any =
		(size === "small" && 180) || (size === "medium" && 198);

	const placeholderImage = `/assets/placeholder/card-${size}.svg`;
	const { t } = useTranslation("common");
	return (
		<Link
			href={href}
			class="group flex justify-center text-center flex-col"
		>
			<div
				class={`relative inline-flex mb-3.5 md:mb-4 lg:mb-5 xl:mb-6 mx-auto ${
					variant === "rounded" ? "rounded-md" : "rounded-full"
				}`}
			>
				<div class="flex">
					<Image
						src={image?.original ?? placeholderImage}
						alt={name || t("text-card-thumbnail")}
						width={imageSize}
						height={imageSize}
						quality={100}
						class={`object-cover bg-gray-300 ${
							variant === "rounded" ? "rounded-md" : "rounded-full"
						}`}
					/>
				</div>
				{effectActive === true && (
					<>
						<div
							class={`absolute top left bg-black w-full h-full opacity-0 transition-opacity duration-300 group-hover:opacity-30 ${
								variant === "rounded" ? "rounded-md" : "rounded-full"
							}`}
						/>
						<div class="absolute top left h-full w-full flex items-center justify-center">
							<FaLink class="text-white text-base sm:text-xl lg:text-2xl xl:text-3xl transform opacity-0 scale-0 transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:scale-100" />
						</div>
					</>
				)}
			</div>
			<Text variant="heading" class="capitalize">
				{name}
			</Text>
		</Link>
	);
};

export default Card;
