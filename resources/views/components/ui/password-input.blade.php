import cn from "classs";
import React, { InputHTMLAttributes, useState } from "react";
import { Eye } from "@components/icons/eye-icon";
import { EyeOff } from "@components/icons/eye-off-icon";
import { useTranslation } from "next-i18next";

export interface Props extends InputHTMLAttributes<HTMLInputElement> {
	class?: string;
	inputclass?: string;
	labelKey: string;
	name: string;
	shadow?: boolean;
	errorKey: string | undefined;
}
const classes = {
	root:
		"py-2 px-4 md:px-5 w-full appearance-none transition duration-150 ease-in-out border border-gray-500 text-input text-xs lg:text-sm font-body rounded-md placeholder-gray-600  transition duration-200 ease-in-out bg-white border border-gray-100 focus:outline-none focus:border-heading h-11 md:h-12",
};
const PasswordInput = React.forwardRef<HTMLInputElement, Props>(
	(
		{
			class = "block",
			inputclass,
			labelKey,
			name,
			errorKey,
			shadow = false,
			...rest
		},
		ref
	) => {
		const [show, setShow] = useState(false);

		const rootclass = cn(classes.root, inputclass);
		const { t } = useTranslation();
		return (
			<div class={class}>
				{labelKey && (
					<label
						htmlFor={name}
						class="block text-gray-600 font-semibold text-sm leading-none mb-3 cursor-pointer"
					>
						{t(labelKey)}
					</label>
				)}
				<div class="relative">
					<input
						id={name}
						name={name}
						type={show ? "text" : "password"}
						ref={ref}
						class={rootclass}
						autoComplete="off"
						autoCapitalize="off"
						spellCheck="false"
						{...rest}
					/>
					<label
						htmlFor={name}
						class="absolute end-4 top-5 -mt-2 text-gray-500 cursor-pointer"
						onClick={() => setShow((prev) => !prev)}
					>
						{show ? (
							<EyeOff class="w-6 h-6" />
						) : (
							<Eye class="w-6 h-6" />
						)}
					</label>
				</div>
				{errorKey && <p class="my-2 text-xs text-red-500">{t(errorKey)}</p>}
			</div>
		);
	}
);

export default PasswordInput;
