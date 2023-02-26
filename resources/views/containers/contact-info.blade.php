import { FC } from "react";
import { IoLocationSharp, IoMail, IoCallSharp } from "react-icons/io5";
import Link from "@components/ui/link";
import { useTranslation } from "next-i18next";
const mapImage = "/assets/images/map-image.jpg";
const data = [
	{
		id: 1,
		slug: "/",
		icon: <IoLocationSharp />,
		name: "text-address",
		description: "text-address-details",
	},
	{
		id: 2,
		slug: "/",
		icon: <IoMail />,
		name: "text-email",
		description: "text-email-details",
	},
	{
		id: 3,
		slug: "/",
		icon: <IoCallSharp />,
		name: "text-phone",
		description: "text-phone-details",
	},
];
interface Props {
	image?: HTMLImageElement;
}
const ContactInfoBlock: FC<Props> = () => {
	const { t } = useTranslation("common");
	return (
		<div class="mb-6 lg:border lg:rounded-md border-gray-300 lg:p-7">
			<h4 class="text-2xl md:text-lg font-bold text-heading pb-7 md:pb-10 lg:pb-6 -mt-1">
				{t("text-find-us-here")}
			</h4>
			{data?.map((item: any) => (
				<div key={`contact--key${item.id}`} class="flex pb-7">
					<div class="flex flex-shrink-0 justify-center items-center p-1.5 border rounded-md border-gray-300 w-10 h-10">
						{item.icon}
					</div>
					<div class="flex flex-col ps-3 2xl:ps-4">
						<h5 class="text-sm font-bold text-heading">
							{t(`${item.name}`)}
						</h5>
						<Link href={item.slug} class="text-sm mt-0">
							{t(`${item.description}`)}
						</Link>
					</div>
				</div>
			))}
			<img src={mapImage} alt={t("text-map")} class="rounded-md" />
		</div>
	);
};

export default ContactInfoBlock;
