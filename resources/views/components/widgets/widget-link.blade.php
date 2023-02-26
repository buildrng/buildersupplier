import type { FC } from "react";
import Link from "next/link";
import { useTranslation } from "next-i18next";

interface Props {
	class?: string;
	data: {
		widgetTitle?: string;
		lists: {
			id: string;
			path?: string;
			title: string;
			icon?: any;
		}[];
	};
}

const WidgetLink: FC<Props> = ({ class, data }) => {
	const { widgetTitle, lists } = data;
	const { t } = useTranslation("footer");
	return (
		<div class={`${class}`}>
			<h4 class="text-heading text-sm md:text-base xl:text-lg font-semibold mb-5 2xl:mb-6 3xl:mb-7">
				{t(`${widgetTitle}`)}
			</h4>
			<ul class="text-xs lg:text-sm text-body flex flex-col space-y-3 lg:space-y-3.5">
				{lists.map((list) => (
					<li
						key={`widget-list--key${list.id}`}
						class="flex items-baseline"
					>
						{list.icon && (
							<span class="me-3 relative top-0.5 lg:top-1 text-sm lg:text-base">
								{list.icon}
							</span>
						)}
						<Link href={list.path ? list.path : "#!"}>
							<a class="transition-colors duration-200 hover:text-black">
								{t(`${list.title}`)}
							</a>
						</Link>
					</li>
				))}
			</ul>
		</div>
	);
};

export default WidgetLink;
