import { Item } from "@contexts/cart/cart.utils";
import { generateCartItemName } from "@utils/generate-cart-item-name";
import usePrice from "@framework/product/use-price";

export const CheckoutItem: React.FC<{ item: Item }> = ({ item }) => {
	const { price } = usePrice({
		amount: item.itemTotal,
		currencyCode: "USD",
	});
	return (
		<div class="flex py-4 items-center lg:px-3 border-b border-gray-300">
			<div class="flex border rounded-md border-gray-300 w-16 h-16 flex-shrink-0">
				<img
					src={item.image ?? "/assets/placeholder/order-product.svg"}
					width="64"
					height="64"
					class="object-cover"
				/>
			</div>
			<h6 class="text-sm ps-3 font-regular text-heading">
				{generateCartItemName(item.name, item.attributes)}
			</h6>
			<div class="flex ms-auto text-heading text-sm ps-2 flex-shrink-0">
				{price}
			</div>
		</div>
	);
};
