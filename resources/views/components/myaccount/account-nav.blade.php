import Link from "next/link";
import { useRouter } from "next/router";
import {
	IoHomeOutline,
	IoCartOutline,
	IoPersonOutline,
	IoSettingsOutline,
	IoLogOutOutline,
} from "react-icons/io5";
import { ROUTES } from "@utils/routes";
import { useLogoutMutation } from "@framework/auth/use-logout";
import { useTranslation } from "next-i18next";

const accountMenu = [
	{
		slug: ROUTES.ACCOUNT,
		name: "text-dashboard",
		icon: <IoHomeOutline class="w-5 h-5" />,
	},
	{
		slug: ROUTES.ORDERS,
		name: "text-orders",
		icon: <IoCartOutline class="w-5 h-5" />,
	},
	{
		slug: ROUTES.ACCOUNT_DETAILS,
		name: "text-account-details",
		icon: <IoPersonOutline class="w-5 h-5" />,
	},
	{
		slug: ROUTES.CHANGE_PASSWORD,
		name: "text-change-password",
		icon: <IoSettingsOutline class="w-5 h-5" />,
	},
];

export default function AccountNav() {
	const { mutate: logout } = useLogoutMutation();
	const { pathname } = useRouter();
	const newPathname = pathname.split("/").slice(2, 3);
	const mainPath = `/${newPathname[0]}`;
	const { t } = useTranslation("common");
	return (
		<nav class="flex flex-col md:w-2/6 2xl:w-4/12 md:pe-8 lg:pe-12 xl:pe-16 2xl:pe-20 pb-2 md:pb-0">
			{accountMenu.map((item) => {
				const menuPathname = item.slug.split("/").slice(2, 3);
				const menuPath = `/${menuPathname[0]}`;

				return (
					<Link key={item.slug} href={item.slug}>
						<a
							class={
								mainPath === menuPath
									? "bg-gray-100 font-semibold flex items-center cursor-pointer text-sm lg:text-base text-heading py-3.5 px-4 lg:px-5 rounded mb-2 "
									: "flex items-center cursor-pointer text-sm lg:text-base text-heading font-normal py-3.5 px-4 lg:px-5 rounded mb-2"
							}
						>
							{item.icon}
							<span class="ps-2">{t(`${item.name}`)}</span>
						</a>
					</Link>
				);
			})}
			<button
				class="flex items-center cursor-pointer text-sm lg:text-base text-heading font-normal py-3.5 px-4 lg:px-5 focus:outline-none"
				onClick={() => logout()}
			>
				<IoLogOutOutline class="w-5 h-5" />
				<span class="ps-2">{t("text-logout")}</span>
			</button>
		</nav>
	);
}
