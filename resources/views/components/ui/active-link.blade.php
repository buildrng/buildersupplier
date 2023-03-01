<Link href={href} {...props}>
			{React.cloneElement(child, {
				class: class || null,
			})}
</Link>