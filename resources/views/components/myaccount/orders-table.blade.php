import { motion } from "framer-motion";
import { fadeInTop } from "@utils/motion/fade-in-top";
import Link from "@components/ui/link";
import { useWindowSize } from "@utils/use-window-size";
import { useTranslation } from "next-i18next";

const OrdersTable: React.FC = () => {
	const { width } = useWindowSize();
	const { t } = useTranslation("common");
	return (
		<>
			<h2 class="text-lg md:text-xl xl:text-2xl font-bold text-heading mb-6 xl:mb-8">
				{t("text-orders")}
			</h2>
			<motion.div
				layout
				initial="from"
				animate="to"
				exit="from"
				//@ts-ignore
				variants={fadeInTop(0.35)}
				class={`w-full flex flex-col`}
			>
				{width >= 1025 ? (
					<table>
						<thead class="text-sm lg:text-base">
							<tr>
								<th class="bg-gray-100 p-4 text-heading font-semibold text-start first:rounded-ts-md">
									{t("text-order")}
								</th>
								<th class="bg-gray-100 p-4 text-heading font-semibold text-start lg:text-center">
									{t("text-date")}
								</th>
								<th class="bg-gray-100 p-4 text-heading font-semibold text-start lg:text-center">
									{t("text-status")}
								</th>
								<th class="bg-gray-100 p-4 text-heading font-semibold text-start lg:text-center">
									{t("text-total")}
								</th>
								<th class="bg-gray-100 p-4 text-heading font-semibold text-start lg:text-end last:rounded-te-md">
									{t("text-actions")}
								</th>
							</tr>
						</thead>
						<tbody class="text-sm lg:text-base">
							<tr class="border-b border-gray-300 last:border-b-0">
								<td class="px-4 py-5 text-start">
									<Link
										href="/my-account/orders/3203"
										class="underline hover:no-underline text-body"
									>
										#3203
									</Link>
								</td>
								<td class="text-start lg:text-center px-4 py-5 text-heading">
									March 18, 2021
								</td>
								<td class="text-start lg:text-center px-4 py-5 text-heading">
									Completed
								</td>
								<td class="text-start lg:text-center px-4 py-5 text-heading">
									$16,950.00 for 93 items
								</td>
								<td class="text-end px-4 py-5 text-heading">
									<Link
										href="/my-account/orders/3203"
										class="text-sm leading-4 bg-heading text-white px-4 py-2.5 inline-block rounded-md hover:text-white hover:bg-gray-600"
									>
										{t("button-view")}
									</Link>
								</td>
							</tr>
							<tr class="border-b border-gray-300 last:border-b-0">
								<td class="px-4 py-5 text-start">
									<Link
										href="/my-account/orders/3204"
										class="underline hover:no-underline text-body"
									>
										#3204
									</Link>
								</td>
								<td class="text-start lg:text-center px-4 py-5 text-heading">
									March 18, 2021
								</td>
								<td class="text-start lg:text-center px-4 py-5 text-heading">
									Completed
								</td>
								<td class="text-start lg:text-center px-4 py-5 text-heading">
									$16,950.00 for 93 items
								</td>
								<td class="text-end px-4 py-5 text-heading">
									<Link
										href="/my-account/orders/3204"
										class="text-sm leading-4 bg-heading text-white px-4 py-2.5 inline-block rounded-md hover:text-white hover:bg-gray-600"
									>
										{t("button-view")}
									</Link>
								</td>
							</tr>
						</tbody>
					</table>
				) : (
					<div class="w-full space-y-4">
						<ul class="text-sm font-semibold text-heading border border-gray-300 rounded-md flex flex-col px-4 pt-5 pb-6 space-y-5">
							<li class="flex items-center justify-between">
								{t("text-order")}
								<span class="font-normal">
									<Link
										href="/my-account/orders/3203"
										class="underline hover:no-underline text-body"
									>
										#3203
									</Link>
								</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-date")}
								<span class="font-normal">March 18, 2021</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-status")}
								<span class="font-normal">Completed</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-total")}
								<span class="font-normal">$16,950.00 for 93 items</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-actions")}
								<span class="font-normal">
									<Link
										href="/my-account/orders/3203"
										class="text-sm leading-4 bg-heading text-white px-4 py-2.5 inline-block rounded-md hover:text-white hover:bg-gray-600"
									>
										{t("button-view")}
									</Link>
								</span>
							</li>
						</ul>
						<ul class="text-sm font-semibold text-heading border border-gray-300 rounded-md flex flex-col px-4 pt-5 pb-6 space-y-5">
							<li class="flex items-center justify-between">
								{t("text-order")}
								<span class="font-normal">
									<Link
										href="/my-account/orders/3204"
										class="underline hover:no-underline text-body"
									>
										#3204
									</Link>
								</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-date")}
								<span class="font-normal">March 18, 2021</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-status")}
								<span class="font-normal">Completed</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-total")}
								<span class="font-normal">$16,950.00 for 93 items</span>
							</li>
							<li class="flex items-center justify-between">
								{t("text-actions")}
								<span class="font-normal">
									<Link
										href="/my-account/orders/3204"
										class="text-sm leading-4 bg-heading text-white px-4 py-2.5 inline-block rounded-md hover:text-white hover:bg-gray-600"
									>
										{t("button-view")}
									</Link>
								</span>
							</li>
						</ul>
					</div>
				)}
			</motion.div>
		</>
	);
};

export default OrdersTable;
