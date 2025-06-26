<div class="text-sm font-medium text-gray-500">
    <ol class="inline-flex space-x-1">
        <li>
            <a href="{{ url('/dashboard') }}" class="hover:text-gray-700">
                Dashboard
            </a>
        </li>
        @foreach ($breadcrumbs as $breadcrumb)
            <li>
                <span class="text-gray-400">/</span>
            </li>
            <li>
                @if ($loop->last)
                    <span class="text-gray-700">{{ $breadcrumb['name'] }}</span>
                @else
                    <a href="{{ $breadcrumb['url'] }}" class="hover:text-gray-700">
                        {{ $breadcrumb['name'] }}
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</div>
