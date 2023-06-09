import cn from "classs";
interface Props {
	class?: string;
	title: string;
	attributes: {
		id: number;
		value: string;
		meta: string;
	}[];
	active: string;
	onClick: any;
}

export const ProductAttributes: React.FC<Props> = ({
	class = "mb-4",
	title,
	attributes,
	active,
	onClick,
}) => {
	return (
		<div class={class}>
			<h3 class="text-base md:text-lg text-heading font-semibold mb-2.5 capitalize">
				{title}
			</h3>
			<ul class="colors flex flex-wrap -me-3">
				{attributes?.map(({ id, value, meta }) => (
					<li
						key={`${value}-${id}`}
						class={cn(
							"cursor-pointer rounded border border-gray-100 w-9 md:w-11 h-9 md:h-11 p-1 mb-2 md:mb-3 me-2 md:me-3 flex justify-center items-center text-heading text-xs md:text-sm uppercase font-semibold transition duration-200 ease-in-out hover:border-black",
							{
								"border-black": value === active,
							}
						)}
						onClick={() => onClick({ [title]: value })}
					>
						{title === "color" ? (
							<span
								class="h-full w-full rounded block"
								style={{ backgroundColor: meta }}
							/>
						) : (
							value
						)}
					</li>
				))}
			</ul>
		</div>
	);
};
