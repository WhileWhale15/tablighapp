<div class="overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                        {{ $header }}
                    </th>
                @endforeach
                @if (isset($actions))
                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($rows as $row)
                <tr>
                    @foreach ($columns as $column)
                        <td class="px-6 py-3 text-sm text-gray-800">
                            {{ data_get($row, $column) }}
                        </td>
                    @endforeach
                    @if (isset($actions))
                        <td class="px-6 py-3 text-end text-sm font-medium">
                            {{ $actions($row) }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if (isset($pagination))
    <div class="py-3 px-4 flex justify-center">
        {{ $pagination }}
    </div>
@endif