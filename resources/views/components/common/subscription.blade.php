import Text from "@components/ui/text";
import Input from "@components/ui/input";
import Button from "@components/ui/button";
import { useForm } from "react-hook-form";
import { useTranslation } from "next-i18next";

const data = {
	title: "common:text-subscribe-heading",
	description: "common:text-subscribe-description",
	buttonText: "common:button-subscribe",
};

interface Props {
	class?: string;
}

type FormValues = {
	subscription_email: string;
};

const defaultValues = {
	subscription_email: "",
};

const Subscription: React.FC<Props> = ({
	class = "px-5 sm:px-8 md:px-16 2xl:px-24",
}) => {
	const {
		register,
		handleSubmit,
		formState: { errors },
	} = useForm<FormValues>({
		defaultValues,
	});
	const { t } = useTranslation();
	const { title, description, buttonText } = data;
	async function onSubmit(input: FormValues) {
		console.log(input, "data");
	}
	return (
		<div
			class={`${class} flex flex-col xl:flex-row justify-center xl:justify-between items-center rounded-lg bg-gray-200 py-10 md:py-14 lg:py-16`}
		>
			<div class="-mt-1.5 lg:-mt-2 xl:-mt-0.5 text-center xl:text-start mb-7 md:mb-8 lg:mb-9 xl:mb-0">
				<Text
					variant="mediumHeading"
					class="mb-2 md:mb-2.5 lg:mb-3 xl:mb-3.5"
				>
					{t(`${title}`)}
				</Text>
				<p class="text-body text-xs md:text-sm leading-6 md:leading-7">
					{t(`${description}`)}
				</p>
			</div>
			<form
				onSubmit={handleSubmit(onSubmit)}
				class="flex-shrink-0 w-full sm:w-96 md:w-[545px]"
				noValidate
			>
				<div class="flex flex-col sm:flex-row items-start justify-end">
					<Input
						placeholderKey="forms:placeholder-email-subscribe"
						type="email"
						variant="solid"
						class="w-full"
						inputclass="px-4 lg:px-7 h-12 lg:h-14 text-center sm:text-start bg-white"
						{...register("subscription_email", {
							required: "forms:email-required",
							pattern: {
								value: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
								message: "forms:email-error",
							},
						})}
						errorKey={errors.subscription_email?.message}
					/>
					<Button class="mt-3 sm:mt-0 w-full sm:w-auto sm:ms-2 md:h-full flex-shrink-0">
						<span class="lg:py-0.5">{t(`${buttonText}`)}</span>
					</Button>
				</div>
			</form>
		</div>
	);
};

export default Subscription;
