{{-- resources/views/frontend/partials/stats.blade.php --}}
{{-- Requires: $stats collection from HomeController --}}

@if ($stats->isNotEmpty())
    <section class="stats-sec" id="stats">
        <div class="container">
            <div class="row g-0">
                @foreach ($stats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-ico">
                                <i class="bi {{ $stat->icon }}"></i>
                            </div>
                            <span class="ctr" data-target="{{ $stat->value }}">
                                0<span class="sfx">{{ $stat->suffix }}</span>
                            </span>
                            <span class="stat-lbl">{{ $stat->label }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
