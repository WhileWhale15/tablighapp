@props(['items' => []])

<nav class="flex text-gray-500 text-sm space-x-3 items-center" aria-label="Breadcrumb">
    <a href="{{ route('user.home') }}" class="hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path
                d="M9.91687 4.92433C10.5874 4.4815 11.2424 4.20123 12 4.20123C12.7576 4.20123 13.4126 4.4815 14.0831 4.92433C14.7271 5.34962 15.4555 5.97402 16.355 6.74502L17.5132 7.73776C18.4272 8.52036 19.0627 9.06447 19.4069 9.81284C19.7511 10.5612 19.7507 11.3978 19.7501 12.6011L19.75 17.052C19.75 17.9505 19.7501 18.6997 19.6701 19.2945C19.5857 19.9223 19.4 20.4891 18.9445 20.9445C18.4891 21.4 17.9223 21.5857 17.2945 21.6701C16.7439 21.7441 16.0611 21.7496 15.25 21.75V18C15.25 16.4812 14.0188 15.25 12.5 15.25H11.5C9.98122 15.25 8.75 16.4812 8.75 18V21.75C7.93893 21.7496 7.25606 21.7441 6.70552 21.6701C6.07773 21.5857 5.51093 21.4 5.05546 20.9445C4.59999 20.4891 4.41432 19.9223 4.32991 19.2945C4.24995 18.6997 4.24997 17.9505 4.25 17.052L4.24995 12.6011C4.24932 11.3978 4.24888 10.5612 4.59308 9.81284C4.93728 9.06448 5.57276 8.52036 6.48675 7.73776L7.64503 6.74502C8.5445 5.97403 9.27295 5.34962 9.91687 4.92433Z"
                fill="currentColor" />
            <path
                d="M10.25 21.75H13.75V18C13.75 17.3096 13.1904 16.75 12.5 16.75H11.5C10.8096 16.75 10.25 17.3096 10.25 18V21.75Z"
                fill="currentColor" />
        </svg>
    </a>
    @foreach ($items as $item)
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right-icon lucide-chevron-right">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </span>
        @if (!$loop->last)
            <a href="{{ $item['url'] }}" class="hover:text-gray-700">{{ $item['label'] }}</a>
        @else
            <span class="text-gray-800 font-medium">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
