import MinusIcon from "@components/icons/minus-icon";
import PlusIcon from "@components/icons/plus-icon";
import cn from "classs";
type CounterProps = {
	quantity: number;
	onDecrement: (e: any) => void;
	onIncrement: (e: any) => void;
	disableIncrement?: boolean;
	disableDecrement?: boolean;
	variant?: "default" | "dark";
	class?: string;
};
const Counter: React.FC<CounterProps> = ({
	quantity,
	onDecrement,
	onIncrement,
	disableIncrement = false,
	disableDecrement = false,
	variant = "default",
}) => {
	const size = variant !== "dark" ? "12px" : "10px";
	return (
		<div
			class={cn(
				"group flex items-center justify-between rounded-md overflow-hidden flex-shrink-0",
				{
					"border h-11 md:h-12 border-gray-300": variant === "default",
					"h-8 md:h-9 shadow-navigation bg-heading": variant === "dark",
				}
			)}
		>
			<button
				onClick={onDecrement}
				class={cn(
					"flex items-center justify-center flex-shrink-0 h-full transition ease-in-out duration-300 focus:outline-none",
					{
						"w-10 md:w-12 text-heading border-e border-gray-300 hover:text-white hover:bg-heading":
							variant === "default",
						"w-8 md:w-9 text-white bg-heading hover:bg-gray-600 focus:outline-none":
							variant === "dark",
					}
				)}
				disabled={disableDecrement}
			>
				<MinusIcon width={size} />
			</button>

			<span
				class={cn(
					"font-semibold flex items-center justify-center h-full  transition-colors duration-250 ease-in-out cursor-default flex-shrink-0",
					{
						"text-base text-heading w-12  md:w-20 xl:w-24":
							variant === "default",
						"text-sm text-white w-8 md:w-10 ": variant === "dark",
					}
				)}
			>
				{quantity}
			</span>

			<button
				onClick={onIncrement}
				class={cn(
					"flex items-center justify-center h-full flex-shrink-0 transition ease-in-out duration-300 focus:outline-none",
					{
						"w-10 md:w-12 text-heading border-s border-gray-300 hover:text-white hover:bg-heading":
							variant === "default",
						"w-8 md:w-9 text-white bg-heading hover:bg-gray-600 focus:outline-none":
							variant === "dark",
					}
				)}
				disabled={disableIncrement}
			>
				<PlusIcon width={size} height={size} />
			</button>
		</div>
	);
};
export default Counter;
