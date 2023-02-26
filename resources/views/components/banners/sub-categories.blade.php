<div className="col-span-full" x-data="sub-categories = home.categories">
		<template x-for="sub-category in sub-categories">
            <div x-text="sub-category"></div>
    {{-- <Carousel breakpoints={categoryResponsive} buttonSize="small">
        {isLoading
            ? Array.from({ length: 7 }).map((_, idx) => (
                    <SwiperSlide key={idx}>
                        <CategoryListCardLoader
                            uniqueKey={`category-list-${idx}`}
                        />
                    </SwiperSlide>
              ))
            : data?.categories.data.map((category: any) => (
                    <SwiperSlide key={`sm-category--key${category.id}`}>
                        <CategoryListCard category={category} />
                    </SwiperSlide>
              ))}
    </Carousel>  --}}
		</template>
</div>