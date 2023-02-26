interface DividerProps {
  class?: string;
}

const Divider: React.FC<DividerProps> = ({
  class = "mb-12 lg:mb-14 xl:mb-16 pb-0.5 lg:pb-1 xl:pb-0",
}) => {
  return <div class={`border-t border-gray-300 ${class}`} />;
};

export default Divider;
