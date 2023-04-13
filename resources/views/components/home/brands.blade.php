<div class="mb-11 md:mb-11 lg:mb-12 xl:mb-14 lg:pb-1 xl:pb-0">
    <div class="flex justify-between items-center flex-wrap mb-5 md:mb-6" id="top-products">Brands</div>
    <div class="-mt-8 md:-mt-12">
            {{-- {isLoading && !data
                ? Array.from({ length: 10 }).map((_, idx) => (
                        <SwiperSlide key={idx}>
                            <CardRoundedLoader uniqueKey={`category-${idx}`} />
                        </SwiperSlide>
                  ))
                : brands?.map((brand) => (
                        <SwiperSlide key={`brand--key${brand.id}`}>
                            <Card
                                item={brand}
                                variant="rounded"
                                size="medium"
                                href={{
                                    pathname: ROUTES.SEARCH,
                                    query: { brand: brand.slug },
                                }}
                            />
                        </SwiperSlide>
                  ))} --}}
        </Carousel>
    )}
</div>