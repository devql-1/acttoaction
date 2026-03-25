{{-- resources/views/frontend/partials/_person-card.blade.php --}}
{{-- Used by people.blade.php — receives $person (Person model instance) --}}

<div class="ppl-card">
    <div class="ppl-photo">
        <span class="ppl-role-badge">{{ $person->role_badge }}</span>
        <img src="{{ $person->photo_url }}" alt="{{ $person->name }}" loading="lazy" />
        <div class="ppl-hover-overlay">
            <div class="ppl-hover-name">{{ $person->name }}</div>
            <div class="ppl-hover-links">
                @if ($person->instagram_url)
                    <a href="{{ $person->instagram_url }}" target="_blank" rel="noopener" class="ppl-link">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                @endif
                @if ($person->youtube_url)
                    <a href="{{ $person->youtube_url }}" target="_blank" rel="noopener" class="ppl-link">
                        <i class="bi bi-youtube"></i> YouTube
                    </a>
                @endif
                @if ($person->press_url)
                    <a href="{{ $person->press_url }}" target="_blank" rel="noopener" class="ppl-link">
                        <i class="bi bi-newspaper"></i> {{ $person->press_label ?? 'Press' }}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="ppl-body">
        <h4>{{ $person->name }}</h4>
        <span class="ppl-desig">{{ $person->designation }}</span>
        @if ($person->bio)
            <p>{{ $person->bio }}</p>
        @endif
    </div>
</div>
