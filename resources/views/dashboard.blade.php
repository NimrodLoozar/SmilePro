<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
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
                        {{-- <h4 class="text-xl font-semibold mt-4">Adres</h4>
                        <p>{{ Auth::user()->address }}</p>
                        <h4 class="text-xl font-semibold mt-4">Telefoon</h4>
                        <p>{{ Auth::user()->phone }}</p> --}}
                    </div>
                </div>

                <!-- Berichten -->
                <div class="w-full lg:w-2/3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100" style="max-height: 400px;">
                        <h3 class="text-2xl font-bold mb-4 flex justify-between items-center">
                            Mijn Berichten
                            <div class="flex space-x-2">
                                <button
                                    onclick="document.getElementById('new-conversation-form').classList.toggle('hidden')"
                                    class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                                @if (isset($conversation) && $conversation->messages->isNotEmpty())
                                    {{-- <button
                                        onclick="document.getElementById('edit-conversation-form').classList.toggle('hidden')"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 20h9M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                                        </svg>
                                    </button> --}}
                                    <button onclick="confirmDelete()" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <form id="delete-message-form"
                                        action="{{ route('messages.deleteLastMessage', ['conversation' => $conversation->id]) }}"
                                        method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <script>
                                        function confirmDelete() {
                                            if (confirm('Weet je zeker dat je het laatste bericht wilt verwijderen?')) {
                                                document.getElementById('delete-message-form').submit();
                                            }
                                        }
                                    </script>
                                @endif
                            </div>
                        </h3>
                        <form id="new-conversation-form" action="{{ route('conversations.create') }}" method="POST"
                            class="hidden mb-4">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <select name="recipient" required
                                    class="p-2 border border-gray-300 text-gray-900 rounded">
                                    <option value="dentist">Dentist</option>
                                    <option value="Hulpdesk">Hulpdesk</option>
                                </select>
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Nieuw
                                    Gesprek</button>
                            </div>
                        </form>
                        <div class="flex flex-row lg:flex-row gap-4">
                            <div class="lg:w-1/3 mb-4">
                                <h4 class="text-xl font-semibold mb-2">Mijn Gesprekken</h4>
                                <ul class="space-y-2" style="max-height: 135px; overflow-y: auto;">
                                    @if ($allConversations->isEmpty())
                                        <li class="text-gray-500">Je hebt nog geen gesprekken gestart.</li>
                                    @else
                                        @foreach ($allConversations as $conv)
                                            <li>
                                                <a href="{{ route('dashboard', ['conversation_id' => $conv->id]) }}"
                                                    class="inline-block p-2 rounded {{ request('conversation_id') == $conv->id ? 'bg-blue-500 text-white' : 'bg-gray-700 text-blue-500 hover:bg-gray-600' }}">
                                                    Gesprek met
                                                    {{ $conv->recipient == 'admin' ? 'Hulpdesk' : $conv->recipient }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="lg:w-2/3">
                                @if ($conversation && $conversation->messages->isEmpty())
                                    <p class="text-gray-500">Je hebt nog geen berichten verstuurd.</p>
                                @elseif ($conversation)
                                    <ul class="space-y-2" style="max-height: 135px; overflow-y: auto;">
                                        @foreach ($conversation->messages as $message)
                                            <li class="p-4 bg-gray-800 shadow rounded-lg mb-4">
                                                <div
                                                    class="{{ $message->user_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                                    <span
                                                        class="text-gray-300 break-words">{{ $message->content }}</span>
                                                    @if ($message->user_id == Auth::id())
                                                        <button
                                                            onclick="document.getElementById('edit-message-form-{{ $message->id }}').classList.toggle('hidden')"
                                                            class="text-yellow-500 hover:text-yellow-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 20h9M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                                                            </svg>
                                                        </button>
                                                        <form id="edit-message-form-{{ $message->id }}"
                                                            action="{{ route('messages.update', ['conversation' => $conversation->id, 'message' => $message->id]) }}"
                                                            method="POST" class="hidden mt-4">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="flex items-center space-x-4">
                                                                <input type="text" name="content"
                                                                    value="{{ $message->content }}" required
                                                                    class="flex-1 p-2 border border-gray-300 text-gray-900 rounded">
                                                                <button type="submit"
                                                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
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
                                                class="flex-1 p-2 border border-gray-300 text-gray-900 rounded">
                                            <button type="submit"
                                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Verstuur</button>
                                        </div>
                                    </form>
                                    @if ($conversation->messages->isNotEmpty())
                                        <form id="edit-conversation-form"
                                            action="{{ route('messages.update', ['conversation' => $conversation->id]) }}"
                                            method="POST" class="hidden mt-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex items-center space-x-4">
                                                <input type="text" name="content"
                                                    value="{{ $conversation->messages->last()->content }}" required
                                                    class="flex-1 p-2 border border-gray-300 rounded">
                                                <button type="submit"
                                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                                            </div>
                                        </form>
                                    @endif
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
