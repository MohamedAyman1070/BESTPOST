<span class="w-fit rounded-full" style="background-color: rgb({{ $user['background_color'] }});">
    <a href="/profile/{{ $user['userTag'] }}">
        <img class="w-{{ $size }} h-{{ $h ?? $size }} rounded-full object-cover"
            src="{{ $user['photos']['url'] ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
            alt="profile">
    </a>
</span>
