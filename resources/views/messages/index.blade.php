<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Berichten Overzicht</h1>

        @if ($conversations->isEmpty())
            <p class="text-gray-500">Er zijn momenteel geen berichten te zien.</p>
        @else
            <ul class="space-y-4">
                @foreach ($conversations as $conversation)
                    <li class="p-4 bg-gray-800 shadow rounded-lg mb-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-bold text-gray-300">
                                    Gesprek met {{ $conversation->user->name ?? 'Onbekende gebruiker' }}</h3>
                                <small class="text-gray-500">Gestart op:
                                    {{ $conversation->created_at->format('d-m-Y H:i') }}</small>
                            </div>
                            @if ($conversation->user_id == Auth::id())
                                <div class="flex space-x-2">
                                    <button
                                        onclick="document.getElementById('edit-conversation-form-{{ $conversation->id }}').classList.toggle('hidden')"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 20h9M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDelete({{ $conversation->id }})"
                                        class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <form id="delete-message-form-{{ $conversation->id }}"
                                        action="{{ route('messages.deleteLastMessage', ['conversation' => $conversation->id]) }}"
                                        method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <script>
                                        function confirmDelete(conversationId) {
                                            if (confirm('Weet je zeker dat je het laatste bericht wilt verwijderen?')) {
                                                document.getElementById('delete-message-form-' + conversationId).submit();
                                            }
                                        }
                                    </script>
                                </div>
                            @endif
                        </div>
                        @foreach ($conversation->messages as $message)
                            <div
                                class="p-4 bg-gray-300 shadow rounded-lg mb-4 mr-8 {{ $message->user_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                <span class="text-gray-800 break-words">{{ $message->content }}</span>
                                @if ($message->user_id == Auth::id())
                                    <button
                                        onclick="document.getElementById('edit-message-form-{{ $message->id }}').classList.toggle('hidden')"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 20h9M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                                        </svg>
                                    </button>
                                    <form id="edit-message-form-{{ $message->id }}"
                                        action="{{ route('messages.update', ['conversation' => $conversation->id]) }}"
                                        method="POST" class="hidden mt-4">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center space-x-4">
                                            <input type="text" name="content" value="{{ $message->content }}"
                                                required class="flex-1 p-2 border border-gray-300 rounded">
                                            <button type="submit"
                                                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                        <form action="{{ route('messages.reply', $conversation) }}" method="POST" class="mt-4">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <input type="text" name="content" placeholder="Uw antwoord" required
                                    class="flex-1 p-2 border border-gray-300 rounded">
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Antwoord</button>
                            </div>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
