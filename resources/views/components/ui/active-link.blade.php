import { useRouter } from "next/router";
import Link from "next/link";
import React, { Children } from "react";

const ActiveLink = ({ children, activeclass, href, ...props }: any) => {
	const { pathname } = useRouter();
	const child = Children.only(children);
	const childclass = child.props.class || "";

	const class =
		pathname === href
			? `${childclass} ${activeclass}`.trim()
			: childclass;

	return (
		<Link href={href} {...props}>
			{React.cloneElement(child, {
				class: class || null,
			})}
		</Link>
	);
};

export default ActiveLink;
