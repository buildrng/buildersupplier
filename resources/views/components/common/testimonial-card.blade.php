import Text from '@components/ui/text';
import StarIcon from '@components/icons/star-icon';
import QuoteIcon from '@components/icons/quote-icon';

interface Props {
  item: any;
}

const TestimonialCard: React.FC<Props> = ({ item }) => {
  return (
    <div class="bg-gray-200 rounded-md p-8 sm:p-6 md:p-8 transition duration-300 ease-in-out w-[92%] md:w-[96.5%] lg:w-full mx-auto md:mx-0">
      <div class="w-[90px]">
        <img
          src={item.avatar.src}
          alt={item.name}
          class="rounded-full border-[5px] border-white shadow-avatar"
        />
      </div>
      <Text variant="mediumHeading" class="2xl:text-2xl mt-7">
        {item.name}
      </Text>
      <div class="inline-grid grid-cols-5 gap-1.5 mt-5">
        {Array.from({ length: item.rating }).map((_, idx) => (
          <StarIcon key={idx} />
        ))}
        {Array.from({ length: 5 - item.rating }).map((_, idx) => (
          <StarIcon color="#e6e6e6" key={idx} />
        ))}
      </div>
      <Text class="text-base 2xl:leading-[1.625rem] mt-7">
        <QuoteIcon class="mb-4" />
        {item.text}
      </Text>
    </div>
  );
};

export default TestimonialCard;
