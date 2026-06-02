@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit About Section</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">About Section</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Edit About Section</div></div>
                    <div class="card-body">
                        <form action="{{ route('about-section-update', $aboutSection->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="heading"
                                       value="{{ old('heading', $aboutSection->heading) }}"
                                       class="form-control @error('heading') is-invalid @enderror">
                                @error('heading') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Lead Paragraph</label>
                                <textarea name="lead_text" rows="3" class="form-control">{{ old('lead_text', $aboutSection->lead_text) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Body Paragraph</label>
                                <textarea name="body_text" rows="4" class="form-control">{{ old('body_text', $aboutSection->body_text) }}</textarea>
                            </div>

                            <hr>

                            {{-- Mini Stats --}}
                            <p class="fw-semibold mb-2"><i class="fa fa-bar-chart me-1 text-primary"></i> Mini Stats</p>
                            @php
                                $miniStats = $aboutSection->mini_stats ?? [];
                                // Pad to 3 items
                                while(count($miniStats) < 3) $miniStats[] = ['num'=>'','label'=>''];
                            @endphp
                            <div class="row g-3 mb-4">
                                @foreach($miniStats as $i => $ms)
                                <div class="col-md-4">
                                    <div class="card border bg-light mb-0">
                                        <div class="card-body p-2">
                                            <small class="text-muted fw-semibold d-block mb-1">Stat {{ $i + 1 }}</small>
                                            <input type="text" name="mini_stat_num[]"
                                                   value="{{ old('mini_stat_num.'.$i, $ms['num'] ?? '') }}"
                                                   class="form-control form-control-sm mb-1"
                                                   placeholder="Number e.g. 500">
                                            <input type="text" name="mini_stat_label[]"
                                                   value="{{ old('mini_stat_label.'.$i, $ms['label'] ?? '') }}"
                                                   class="form-control form-control-sm"
                                                   placeholder="Label e.g. Kids Participated">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <hr>

                            {{-- Image --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Image <span class="text-muted fw-normal">(leave empty to keep current)</span>
                                </label>
                                @if($aboutSection->image_url)
                                <div class="mb-2">
                                    <img id="currentImg" src="{{ $aboutSection->image_url }}"
                                         style="height:80px;border-radius:8px;object-fit:cover;">
                                    <small class="text-muted d-block mt-1">Current image</small>
                                </div>
                                @endif
                                <input type="file" name="image"
                                       accept="image/jpeg,image/png,image/webp"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImg(this)">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <hr>

                            <p class="fw-semibold mb-2"><i class="fa fa-tag me-1 text-warning"></i> Orange Badge</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Badge Year</label>
                                    <input type="text" name="badge_year"
                                           value="{{ old('badge_year', $aboutSection->badge_year) }}"
                                           class="form-control" placeholder="e.g. 2025">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Badge Text</label>
                                    <input type="text" name="badge_text"
                                           value="{{ old('badge_text', $aboutSection->badge_text) }}"
                                           class="form-control" placeholder="e.g. Cyber AI Threat Conclave">
                                </div>
                            </div>

                            <p class="fw-semibold mb-2"><i class="fa fa-credit-card me-1 text-success"></i> Floating Info Card</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Card Title</label>
                                    <input type="text" name="fc_title"
                                           value="{{ old('fc_title', $aboutSection->fc_title) }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Card Subtitle</label>
                                    <input type="text" name="fc_subtitle"
                                           value="{{ old('fc_subtitle', $aboutSection->fc_subtitle) }}"
                                           class="form-control">
                                </div>
                            </div>

                            <hr>

                            <p class="fw-semibold mb-2"><i class="fa fa-mouse-pointer me-1 text-info"></i> Action Buttons</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 1 Label</label>
                                    <input type="text" name="btn1_label"
                                           value="{{ old('btn1_label', $aboutSection->btn1_label) }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 1 URL</label>
                                    <input type="text" name="btn1_url"
                                           value="{{ old('btn1_url', $aboutSection->btn1_url) }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 2 Label</label>
                                    <input type="text" name="btn2_label"
                                           value="{{ old('btn2_label', $aboutSection->btn2_label) }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 2 URL</label>
                                    <input type="text" name="btn2_url"
                                           value="{{ old('btn2_url', $aboutSection->btn2_url) }}"
                                           class="form-control">
                                </div>
                            </div>

                            <hr>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           name="status" id="status" value="1"
                                           {{ $aboutSection->status ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="status">Active</label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Update About Section
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Details</div></div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr><td class="text-muted small">ID</td><td>{{ $aboutSection->id }}</td></tr>
                            <tr><td class="text-muted small">Status</td>
                                <td>@if($aboutSection->status)<span class="badge badge-success">Active</span>@else<span class="badge badge-secondary">Inactive</span>@endif</td>
                            </tr>
                            <tr><td class="text-muted small">Updated</td><td class="small">{{ $aboutSection->updated_at->format('d M Y, h:i A') }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function previewImg(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const cur = document.getElementById('currentImg');
        if (cur) cur.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}


</script>
@endsection
