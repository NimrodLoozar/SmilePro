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

        <div class="text-center">
            <h2 class="text-2xl font-semibold mt-8 mb-4">Onze behandelingen</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 mx-auto max-w-6xl">
                <div class="grid h-64 grid-cols-2 gap-1 lg:col-span-1 mb-4 lg:mb-0 lg:mr-4">
                    <img src="{{ asset('images/dentist_1.jpeg') }}" alt="Profile Photo 1"
                        class="w-full h-auto rounded-full">
                    <img src="{{ asset('images/dentist_2.jpeg') }}" alt="Profile Photo 2"
                        class="w-full h-auto rounded-full">
                    <img src="{{ asset('images/dentist_3.jpg') }}" alt="Profile Photo 3"
                        class="w-full h-auto rounded-full">
                    <img src="{{ asset('images/DrAugOet.jpg') }}" alt="Profile Photo 4"
                        class="w-full h-auto rounded-full">
                    <img src="{{ asset('images/dr-mario.jpg') }}" alt="Profile Photo 5"
                        class="w-full h-auto rounded-full col-span-2">
                </div>
                <div class="lg:col-span-2">
                    @foreach ([
        'Controle' => 'Regelmatige tandheelkundige controles zijn essentieel om uw mondgezondheid te waarborgen. Tijdens een controle onderzoekt de tandarts uw tanden, tandvlees en mondholte op tekenen van problemen zoals cariës, tandvleesontsteking en andere aandoeningen. Vroege detectie van problemen kan helpen om ernstigere complicaties te voorkomen. Daarnaast krijgt u advies over mondhygiëne en preventieve zorg. Het is aanbevolen om minstens twee keer per jaar een controle te laten uitvoeren.',
        'Wortelkanaalbehandeling' => 'Een wortelkanaalbehandeling is nodig wanneer de tandzenuw geïnfecteerd of beschadigd is. Deze behandeling verwijdert de geïnfecteerde zenuw en reinigt het binnenste van de tand om verdere infectie te voorkomen. Na de reiniging wordt de tand gevuld en verzegeld. Hoewel de behandeling complex kan zijn, helpt het om de natuurlijke tand te behouden en pijn te verlichten. Na de behandeling kan een kroon worden geplaatst om de tand te versterken.',
        'Vulling' => 'Vullingen worden gebruikt om tanden te herstellen die zijn aangetast door cariës of beschadigd door trauma. Het aangetaste deel van de tand wordt verwijderd en de holte wordt gevuld met een geschikt materiaal zoals composiet, amalgaam of goud. Vullingen helpen om de vorm en functie van de tand te herstellen en verdere schade te voorkomen. Moderne vullingen kunnen ook esthetisch aantrekkelijk zijn en passen bij de kleur van uw natuurlijke tanden. Regelmatige controles helpen om vroegtijdig cariës te detecteren en te behandelen.',
        'Kroon' => 'Een kroon is een kapje dat over een beschadigde tand wordt geplaatst om deze te versterken en te beschermen. Kronen worden vaak gebruikt na een wortelkanaalbehandeling of wanneer een tand ernstig beschadigd is. Ze kunnen gemaakt zijn van verschillende materialen zoals porselein, metaal of een combinatie daarvan. Kronen helpen om de vorm, grootte en functie van de tand te herstellen. Ze bieden ook esthetische voordelen door de tand een natuurlijke uitstraling te geven.',
        'Brug' => 'Een brug is een vaste prothese die een of meer ontbrekende tanden vervangt door de ruimte op te vullen. Bruggen worden ondersteund door de natuurlijke tanden of implantaten aan weerszijden van de lege ruimte. Ze helpen om de functionaliteit van uw gebit te herstellen en voorkomen dat de omliggende tanden verschuiven. Bruggen kunnen ook esthetische voordelen bieden door uw glimlach te verbeteren. Het proces omvat meestal meerdere bezoeken aan de tandarts voor afdrukken, aanpassingen en plaatsing.',
        'Tanden bleken' => 'Tanden bleken is een cosmetische behandeling om de kleur van uw tanden lichter te maken en vlekken te verwijderen. Er zijn verschillende methoden beschikbaar, waaronder professionele behandelingen bij de tandarts en thuisbleeksets. Professionele behandelingen bieden vaak snellere en meer zichtbare resultaten. Het is belangrijk om tanden bleken onder begeleiding van een tandarts te doen om schade aan het tandglazuur te voorkomen. Regelmatige mondhygiëne helpt om de resultaten van de behandeling te behouden.',
        'Tandsteen verwijderen' => 'Tandsteen verwijderen is een belangrijke procedure om tandvleesontsteking en parodontitis te voorkomen. Tandsteen is verharde tandplak die niet kan worden verwijderd door gewoon poetsen en flossen. Professionele gebitsreiniging door een tandarts of mondhygiënist helpt om tandsteen en tandplak te verwijderen. Regelmatige reinigingen dragen bij aan een gezonde mond en voorkomen ernstige tandvleesproblemen. Na de reiniging krijgt u advies over hoe u tandsteen in de toekomst kunt voorkomen.',
        'Extractie' => 'Extractie is de verwijdering van een tand die ernstig beschadigd of geïnfecteerd is en niet kan worden gered. Dit kan nodig zijn bij ernstige cariës, gebroken tanden of ernstige tandvleesontsteking. De procedure wordt meestal uitgevoerd onder lokale verdoving om pijn te minimaliseren. Na de extractie krijgt u instructies voor nazorg om genezing te bevorderen en complicaties te voorkomen. In sommige gevallen kan een vervangende tand of implantaat worden aanbevolen om de functie en esthetiek van uw gebit te herstellen.',
        'Implantaat' => 'Een implantaat is een kunstmatige tandwortel die in de kaak wordt geplaatst om een vervangende tand of brug te ondersteunen. Implantaten zijn een duurzame en effectieve oplossing voor ontbrekende tanden. Ze bieden stabiliteit en functionaliteit die vergelijkbaar is met natuurlijke tanden. Het proces omvat meestal meerdere stappen, waaronder de plaatsing van het implantaat, genezing en de bevestiging van de vervangende tand. Implantaten helpen om de kaakstructuur te behouden en voorkomen dat omliggende tanden verschuiven.',
        'Beugel' => 'Een beugel is een orthodontische behandeling om tanden recht te zetten en de beet te verbeteren. Beugels kunnen metalen, keramische of doorzichtige materialen bevatten. De behandeling helpt om scheve tanden, overbeet, onderbeet en andere tandheelkundige problemen te corrigeren. Het proces kan enkele maanden tot enkele jaren duren, afhankelijk van de complexiteit van het geval. Regelmatige controles bij de orthodontist zijn nodig om de voortgang te volgen en aanpassingen te maken.',
        'Gebitsreiniging' => 'Gebitsreiniging is een grondige reiniging van tanden en tandvlees om tandplak en tandsteen te verwijderen. Professionele reiniging helpt om tandvleesontsteking en parodontitis te voorkomen. Tijdens de reiniging worden ook oppervlakkige vlekken verwijderd, waardoor uw tanden er schoner en helderder uitzien. Regelmatige gebitsreinigingen dragen bij aan een gezonde mond en voorkomen ernstige tandheelkundige problemen. Uw tandarts of mondhygiënist kan u ook advies geven over mondhygiëne en preventieve zorg.',
        'Fluoridebehandeling' => 'Fluoridebehandeling is het aanbrengen van fluoride op de tanden om tandbederf te voorkomen en de tanden te versterken. Fluoride helpt om het tandglazuur te remineraliseren en maakt het minder vatbaar voor zuurvorming door bacteriën. De behandeling is snel en pijnloos en kan tijdens een reguliere controle worden uitgevoerd. Fluoridebehandelingen zijn vooral nuttig voor kinderen, maar kunnen ook voordelen bieden voor volwassenen. Regelmatige fluoridebehandelingen helpen om de mondgezondheid te behouden.',
        'Röntgenfoto' => 'Röntgenfoto\'s zijn een diagnostisch hulpmiddel om de gezondheid van tanden, wortels en kaakbot te beoordelen. Ze helpen om problemen te detecteren die niet zichtbaar zijn tijdens een klinisch onderzoek, zoals cariës tussen tanden, geïnfecteerde wortels en botverlies. Röntgenfoto\'s zijn een essentieel onderdeel van een uitgebreide tandheelkundige evaluatie. De procedure is snel en veilig, met minimale blootstelling aan straling. Uw tandarts zal de resultaten van de röntgenfoto\'s met u bespreken en een behandelplan opstellen indien nodig.',
        'Prothese' => 'Een prothese is een uitneembare vervanging voor ontbrekende tanden en omliggende weefsels. Protheses kunnen volledig of gedeeltelijk zijn, afhankelijk van het aantal ontbrekende tanden. Ze helpen om de functionaliteit van uw gebit te herstellen en verbeteren uw vermogen om te kauwen en te spreken. Protheses worden op maat gemaakt om comfortabel en natuurlijk te passen. Regelmatige controles bij de tandarts zijn nodig om de pasvorm en conditie van de prothese te controleren.',
        'Tandvleesbehandeling' => 'Tandvleesbehandeling is gericht op de behandeling van tandvleesontsteking en parodontitis om de gezondheid van het tandvlees te verbeteren. Dit kan scaling en root planing omvatten, waarbij tandplak en tandsteen onder de tandvleesrand worden verwijderd. In ernstige gevallen kan een chirurgische ingreep nodig zijn om beschadigd weefsel te herstellen. Regelmatige tandvleesbehandelingen helpen om tandverlies en andere complicaties te voorkomen. Uw tandarts zal u ook advies geven over mondhygiëne en preventieve zorg.',
    ] as $treatment => $description)
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold mb-2">{{ $treatment }}</h3>
                            <p>{{ $description }}</p>
                        </div>
                    @endforeach
                </div>
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
