<x-layout>
    <div class="text-center">
        <h2 class="text-3xl font-semibold mb-4">Welkom bij SmilePro</h2>
        <p class="text-lg">Bij SmilePro bieden wij professionele en vriendelijke tandheelkundige zorg voor het hele
            gezin. Uw glimlach is onze prioriteit!</p>
    </div>

    <div class="text-center">
        <h2 class="text-2xl font-semibold mt-8 mb-4">Onze diensten</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded hover-box shadow-[2px_2px_5px_rgba(0,0,0,0.5)]">
                <h3 class="text-xl font-semibold mb-2">Tandheelkundige controles</h3>
                <p>Wij bieden regelmatige tandheelkundige controles om uw mondgezondheid te controleren en problemen te
                    voorkomen.</p>
            </div>
            <div class="bg-white p-4 rounded hover-box shadow-[2px_2px_5px_rgba(0,0,0,0.5)]">
                <h3 class="text-xl font-semibold mb-2">Tandheelkundige reiniging</h3>
                <p>Professionele tandheelkundige reiniging om tandplak en tandsteen te verwijderen en uw tanden te
                    beschermen tegen tandbederf.</p>
            </div>
            <div class="bg-white p-4 rounded hover-box shadow-[2px_2px_5px_rgba(0,0,0,0.5)]">
                <h3 class="text-xl font-semibold mb-2">Tandheelkundige behandelingen</h3>
                <p>Wij bieden een breed scala aan tandheelkundige behandelingen, waaronder vullingen, wortelkanalen en
                    tandextracties.</p>
            </div>
        </div>

        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Stuur een bericht</h1>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="flex items-center space-x-4">
                    <input type="text" name="content" placeholder="Uw bericht" required
                        class="flex-1 p-2 border border-gray-300 rounded shadow-[2px_2px_5px_rgba(0,0,0,0.5)]">
                    <button type="submit"
                        class="bg-green-400 text-white px-4 py-2 rounded hover:bg-green-300 hover-box shadow-[2px_2px_5px_rgba(0,0,0,0.5)]">Verstuur</button>
                </div>
            </form>
        </div>
</x-layout>
