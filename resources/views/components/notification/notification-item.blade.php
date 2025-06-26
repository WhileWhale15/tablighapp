<a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
    <x-notification-avatar :src="$avatar" :badgeColor="$badgeColor" :icon="$icon" />
    <div class="pl-3 w-full">
        <x-notification-text :name="$name" :message="$message" />
        <div class="text-xs font-medium text-primary-600">
            {{ $timeAgo }}
        </div>
    </div>
</a>
