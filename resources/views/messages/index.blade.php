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
                        </div>
                        @foreach ($conversation->messages as $message)
                            <div
                                class="p-4 bg-gray-300 shadow rounded-lg mb-4 mr-8 {{ $message->user_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                <span class="text-gray-800 break-words">{{ $message->content }}</span>
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
