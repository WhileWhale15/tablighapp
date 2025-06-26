<x-layout>
    <div class="notifications-container">
        @foreach ($notifications as $notification)
            <x-notification-item :avatar="$notification['avatar']" :badgeColor="$notification['badgeColor']"
                :icon="$notification['icon']" :name="$notification['name']" :message="$notification['message']"
                :timeAgo="$notification['timeAgo']" />
        @endforeach
    </div>
</x-layout>