<x-filament-widgets::widget>
    <x-filament::section>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 d-flex justify-content-between"
            style="display: flex; justify-content: space-between;">
            <!-- Saat Widget -->
            <div class="flex items-center justify-center space-x-4 p-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg text-white">
                <div class="text-8xl" style="font-size: 30px;">🕐</div>

                <div class="text-center">
                    <div class="text-sm">{{ $currentDate }}</div>
                    <div class="text-xs opacity-75">{{ $currentDay }}</div>
                </div>
            </div>

            <!-- Hava Durumu Widget -->
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg text-white">
                <div class="text-center">
                    <div class="text-3xl mb-1"  style="font-size: 30px;">{{ $icon }}</div>
                    <div class="text-xl font-bold">{{ $temperature }}°C</div>
                </div>
                <div>
                    <div class="text-lg font-bold">{{ $city }}</div>
                </div>

            </div>
        </div>
    </x-filament::section>

    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('tr-TR');
            const clockElement = document.getElementById('clock');
            if (clockElement) {
                clockElement.textContent = time;
            }
        }

        setInterval(updateClock, 1000);
    </script>
</x-filament-widgets::widget>
