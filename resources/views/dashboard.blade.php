<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Gebruikersgegevens -->
                <div
                    class="w-full lg:w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 lg:mb-0">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">Mijn Gegevens</h3>
                        <h4 class="text-xl font-semibold">Naam</h4>
                        <p>{{ Auth::user()->name }}</p>
                        <h4 class="text-xl font-semibold mt-4">Email</h4>
                        <p>{{ Auth::user()->email }}</p>
                        <h4 class="text-xl font-semibold mt-4">Adres</h4>
                        <p>{{ Auth::user()->address }}</p>
                        <h4 class="text-xl font-semibold mt-4">Telefoon</h4>
                        <p>{{ Auth::user()->phone }}</p>
                    </div>
                </div>

                <!-- Berichten -->
                <div class="w-full lg:w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100" style="max-height: 300px;">
                        <h3 class="text-2xl font-bold mb-4 flex justify-between items-center">
                            Mijn Berichten
                            <button
                                onclick="document.getElementById('new-conversation-form').classList.toggle('hidden')"
                                class="text-blue-500 hover:text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </h3>
                        <form id="new-conversation-form" action="{{ route('conversations.create') }}" method="POST"
                            class="hidden mb-4">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <select name="recipient" required class="p-2 border border-gray-300 rounded">
                                    <option value="dentist">Dentist</option>
                                    <option value="Hulpdesk">Hulpdesk</option>
                                </select>
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Nieuw
                                    Gesprek</button>
                            </div>
                        </form>
                        <div class="flex flex-col lg:flex-row gap-4">
                            <div class="lg:w-1/3 mb-4">
                                <h4 class="text-xl font-semibold mb-2">Mijn Gesprekken</h4>
                                <ul class="space-y-2">
                                    @foreach ($allConversations as $conv)
                                        <li>
                                            <a href="{{ route('dashboard', ['conversation_id' => $conv->id]) }}"
                                                class="inline-block p-2 rounded {{ request('conversation_id') == $conv->id ? 'bg-blue-500 text-white' : 'bg-gray-700 text-blue-500 hover:bg-gray-600' }}">
                                                Gesprek met
                                                {{ $conv->recipient == 'admin' ? 'Hulpdesk' : $conv->recipient }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="lg:w-2/3">
                                @if ($conversations->isEmpty())
                                    <p class="text-gray-500">Je hebt nog geen berichten verstuurd.</p>
                                @else
                                    <ul class="space-y-4" style="max-height: 165px; overflow-y: auto;">
                                        @foreach ($conversations as $conversation)
                                            <li class="p-4 bg-gray-800 shadow rounded-lg mb-4">
                                                @foreach ($conversation->messages as $message)
                                                    <div
                                                        class="{{ $message->user_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                                        <span
                                                            class="text-gray-300 break-words">{{ $message->content }}</span>
                                                    </div>
                                                @endforeach
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if (isset($conversation))
                                    <form action="{{ route('messages.reply', ['conversation' => $conversation->id]) }}"
                                        method="POST" class="mt-4">
                                        @csrf
                                        <div class="flex items-center space-x-4">
                                            <input type="text" name="content" placeholder="Uw bericht" required
                                                class="flex-1 p-2 border border-gray-300 rounded">
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Verstuur</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100" style="max-height: 500px; overflow-y: auto;">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('appointments.index') }}">Jouw Afspraken</a>
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a href="{{ route('appointments.index') }}">Alle Afspraken</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
