<x-app-layout>
    <div class="container mx-auto p-6">

        <form method="GET" action="{{ route('attractions.search') }}" class="mb-6 flex space-x-4">
            <input type="text" name="keyword" placeholder="Buscar..." value="{{ request('keyword') }}" class="border p-2 rounded flex-grow" />
            <select name="type" class="border p-2 rounded">
                <option value="">Tipo</option>
                <option value="playa" @selected(request('type') == 'playa')>Playa</option>
                <option value="sitio arqueológico" @selected(request('type') == 'sitio arqueológico')>Sitio Arqueológico</option>
                <option value="festival" @selected(request('type') == 'festival')>Festival</option>
                <!-- Agrega más tipos según tu tabla -->
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 rounded">Buscar</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($attractions as $attraction)
                <div class="border rounded p-4">
                    <h2 class="font-bold">{{ $attraction->name }}</h2>
                    <p>{{ $attraction->type }}</p>
                    <p>{{ $attraction->description }}</p>
                </div>
            @endforeach
        </div>

        {{ $attractions->withQueryString()->links() }}

    </div>
</x-app-layout>
