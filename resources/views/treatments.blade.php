<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Behandelingen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Error Button -->
            <div class="mb-4">
                <button onclick="toggleError()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Toon Error
                </button>
            </div>

            <!-- Error Message (Hidden by default) -->
            <div id="errorMessage" class="bg-red-500 text-white p-4 rounded mb-4 hidden">
                Probeer later opnieuw.
            </div>

            <!-- Treatments Content -->
            <div id="treatmentsContent" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6">Onze Behandelingen</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-700">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        Behandeling
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        Omschrijving
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">
                                        Inbegrepen
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Reguliere Controle</td>
                                    <td class="px-6 py-4 text-sm">Halfjaarlijkse controle van uw gebit en mondgezondheid</td>
                                    <td class="px-6 py-4 text-sm">Gebitscontrole, Tandvleescontrole, Mondkanker screening</td>
                                </tr>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Gebitsreiniging</td>
                                    <td class="px-6 py-4 text-sm">Professionele reiniging en tandsteenverwijdering</td>
                                    <td class="px-6 py-4 text-sm">Tandsteenverwijdering, Polijsten, Fluoridebehandeling</td>
                                </tr>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Vullingen</td>
                                    <td class="px-6 py-4 text-sm">Herstel van aangetaste tanden</td>
                                    <td class="px-6 py-4 text-sm">Composiet vullingen, Amalgaam vullingen, Tijdelijke vullingen</td>
                                </tr>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Wortelkanaalbehandeling</td>
                                    <td class="px-6 py-4 text-sm">Behandeling van geïnfecteerde tandzenuw</td>
                                    <td class="px-6 py-4 text-sm">Ontstekingsbehandeling, Zenuwverwijdering, Definitieve afsluiting</td>
                                </tr>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Kronen en Bruggen</td>
                                    <td class="px-6 py-4 text-sm">Herstel van ernstig beschadigde tanden</td>
                                    <td class="px-6 py-4 text-sm">Porselein kronen, Vaste bruggen, Tijdelijke kronen</td>
                                </tr>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Preventieve Zorg</td>
                                    <td class="px-6 py-4 text-sm">Voorkomen van tandheelkundige problemen</td>
                                    <td class="px-6 py-4 text-sm">Mondhygiëne advies, Sealing, Fluoridebehandeling</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleError() {
            const errorMessage = document.getElementById('errorMessage');
            const treatmentsContent = document.getElementById('treatmentsContent');
            
            errorMessage.classList.remove('hidden');
            treatmentsContent.classList.add('hidden');
        }
    </script>
</x-app-layout>