import cn from "classs";
interface Props {
	class?: string;
	children?: any;
	el?: HTMLElement;
	clean?: boolean;
}

const Container: React.FC<Props> = ({
	children,
	class,
	el = "div",
	clean,
}) => {
	const rootclass = cn(class, {
		"mx-auto max-w-[1920px] px-4 md:px-8 2xl:px-16": !clean,
	});

	let Component: React.ComponentType<
		React.HTMLAttributes<HTMLDivElement>
	> = el as any;

	return <Component class={rootclass}>{children}</Component>;
};

export default Container;
