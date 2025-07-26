@props(['promotions'])

<!-- Promotion Carousel -->
<div class="py-2 px-4 relative">
    <div id="promotion-carousel" class="overflow-x-auto scrollbar-hide cursor-grab">
        <div class="flex gap-4 w-max">
            @forelse($promotions as $promotion)
                <div class="promotion-card rounded-lg w-72 h-48 relative overflow-hidden cursor-pointer shadow-lg flex-shrink-0"
                    onclick="window.location.href='{{ route('promotion.show', $promotion) }}'">
                    @if ($promotion->image)
                        <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}"
                            class="w-full h-full object-cover">
                    @else
                        <!-- Fallback gradient if no image -->
                        <div
                            class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <h4 class="font-bold text-lg mb-2">{{ $promotion->title }}</h4>
                                <p class="text-white/80 text-sm">
                                    {{ Str::limit(strip_tags($promotion->content), 60) }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($promotion->image)
                        <!-- Overlay for better text readability -->
                        <div class="absolute inset-0 bg-black/20"></div>
                        <!-- Title overlay -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                            <h4 class="font-bold text-white text-lg">{{ $promotion->title }}</h4>
                        </div>
                    @endif
                </div>
            @empty
                <div
                    class="promotion-card bg-gradient-to-r from-gray-400 to-gray-500 rounded-lg p-4 w-72 text-white relative overflow-hidden flex-shrink-0">
                    <div class="relative z-10">
                        <h4 class="font-bold text-lg mb-2">ไม่มีโปรโมชั่น</h4>
                        <p class="text-white/80 text-sm mb-3">ขณะนี้ยังไม่มีโปรโมชั่นพิเศษ</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Indicators -->
    @if ($promotions->count() > 1)
        <div class="flex justify-center mt-4">
            <div class="flex space-x-2" id="carousel-indicators">
                @foreach ($promotions as $index => $promotion)
                    <div class="carousel-indicator w-2 h-2 rounded-full bg-gray-300 transition-colors {{ $index === 0 ? 'bg-blue-600' : '' }}"
                        data-index="{{ $index }}"></div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('promotion-carousel');
        if (!carousel) return;

        const indicators = document.querySelectorAll('.carousel-indicator');
        const cards = document.querySelectorAll('.promotion-card');

        let isDown = false;
        let startX;
        let scrollLeft;

        // Update indicators based on scroll position
        function updateIndicators() {
            if (!indicators.length || !cards.length) return;

            const carouselRect = carousel.getBoundingClientRect();
            const carouselCenter = carouselRect.left + carouselRect.width / 2;

            let activeIndex = 0;
            let minDistance = Infinity;

            cards.forEach((card, index) => {
                const cardRect = card.getBoundingClientRect();
                const cardCenter = cardRect.left + cardRect.width / 2;
                const distance = Math.abs(cardCenter - carouselCenter);

                if (distance < minDistance) {
                    minDistance = distance;
                    activeIndex = index;
                }
            });

            // Update indicator styles
            indicators.forEach((indicator, index) => {
                if (index === activeIndex) {
                    indicator.classList.remove('bg-gray-300');
                    indicator.classList.add('bg-blue-600');
                } else {
                    indicator.classList.remove('bg-blue-600');
                    indicator.classList.add('bg-gray-300');
                }
            });
        }

        // Mouse drag functionality
        carousel.addEventListener('mousedown', (e) => {
            isDown = true;
            carousel.classList.add('cursor-grabbing');
            carousel.classList.remove('cursor-grab');
            startX = e.pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
            e.preventDefault();
        });

        carousel.addEventListener('mouseleave', () => {
            isDown = false;
            carousel.classList.remove('cursor-grabbing');
            carousel.classList.add('cursor-grab');
        });

        carousel.addEventListener('mouseup', () => {
            isDown = false;
            carousel.classList.remove('cursor-grabbing');
            carousel.classList.add('cursor-grab');
        });

        carousel.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - carousel.offsetLeft;
            const walk = (x - startX) * 2;
            carousel.scrollLeft = scrollLeft - walk;
        });

        // Update indicators on scroll
        carousel.addEventListener('scroll', updateIndicators);

        // Mouse wheel support
        carousel.addEventListener('wheel', (e) => {
            if (e.deltaY !== 0) {
                e.preventDefault();
                carousel.scrollLeft += e.deltaY;
            }
        });

        // Prevent click events when dragging
        let isDragging = false;
        carousel.addEventListener('mousedown', () => {
            isDragging = false;
        });

        carousel.addEventListener('mousemove', () => {
            isDragging = true;
        });

        // Modify promotion card clicks to prevent navigation when dragging
        const promotionCards = carousel.querySelectorAll('[onclick]');
        promotionCards.forEach(card => {
            const originalOnclick = card.getAttribute('onclick');
            card.removeAttribute('onclick');

            card.addEventListener('click', (e) => {
                if (!isDragging) {
                    eval(originalOnclick);
                }
                isDragging = false;
            });
        });

        // Indicator click functionality
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                if (cards[index]) {
                    const cardLeft = cards[index].offsetLeft;
                    const cardWidth = cards[index].offsetWidth;
                    const carouselWidth = carousel.offsetWidth;
                    const targetScroll = cardLeft - (carouselWidth - cardWidth) / 2;

                    carousel.scrollTo({
                        left: Math.max(0, targetScroll),
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Initial indicator update
        setTimeout(updateIndicators, 100);
    });
</script>
