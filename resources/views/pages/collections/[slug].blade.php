import Container from "@components/ui/container";
import Layout from "@components/layout/layout";
import Subscription from "@components/common/subscription";
import StickyBox from "react-sticky-box";
import { ProductGrid } from "@components/product/product-grid";
import ActiveLink from "@components/ui/active-link";
import { BreadcrumbItems } from "@components/common/breadcrumb";
import { serverSideTranslations } from "next-i18next/serverSideTranslations";
import { ROUTES } from "@utils/routes";
import { useTranslation } from "next-i18next";
import CollectionTopBar from "@components/collection/collection-top-bar";
import { CollectionFilters } from "@components/collection/collection-filters";
import { GetServerSideProps } from "next";

export default function Shop() {
	const { t } = useTranslation("common");

	return (
		<div class="border-t-2 border-borderBottom">
			<Container>
				<div class={`flex pt-8 pb-16 lg:pb-20`}>
					<div class="flex-shrink-0 pe-24 hidden lg:block w-96">
						<StickyBox offsetTop={50} offsetBottom={20}>
							<div class="pb-7">
								<BreadcrumbItems separator="/">
									<ActiveLink
										href={"/"}
										activeclass="font-semibold text-heading"
									>
										<a>{t("breadcrumb-home")}</a>
									</ActiveLink>
									<ActiveLink
										href={ROUTES.SEARCH}
										activeclass="font-semibold text-heading"
									>
										<a class="capitalize">{t("breadcrumb-collection")}</a>
									</ActiveLink>
								</BreadcrumbItems>
							</div>
							<CollectionFilters />
						</StickyBox>
					</div>

					<div class="w-full lg:-ms-9">
						<CollectionTopBar />
						<ProductGrid />
					</div>
				</div>
				<Subscription />
			</Container>
		</div>
	);
}

Shop.Layout = Layout;

export const getServerSideProps: GetServerSideProps = async ({ locale }) => {
	return {
		props: {
			...(await serverSideTranslations(locale!, [
				"common",
				"forms",
				"menu",
				"footer",
			])),
		},
	};
};