<div wire:poll.5s>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Type
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Message
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Heure
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($notifications as $notif)
                <tr
                    class="{{ $notif->valeur >= 150 ? 'bg-red-50' : ($notif->valeur >= 120 ? 'bg-orange-50' : ($notif->valeur >= 90 ? 'bg-yellow-50' : 'bg-green-50')) }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $notif->valeur >= 150 ? 'bg-red-100 text-red-800' : ($notif->valeur >= 120 ? 'bg-orange-100 text-orange-800' : ($notif->valeur >= 90 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) }}">
                            {{ strtoupper($notif->type ?? 'Alerte') }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $notif->message }}</div>
                        <div class="text-sm text-gray-500">{{ $notif->piece }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i> {{ $notif->created_at->format('H:i:s') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-gray-600 hover:text-gray-900 mr-3">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-green-600 hover:text-green-900">
                            <i class="fas fa-check"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
