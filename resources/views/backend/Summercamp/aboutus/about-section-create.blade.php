@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">About Section</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">About Section</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">About Section Content</div></div>
                    <div class="card-body">
                        <form action="{{ route('about-section-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Heading --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Heading <span class="text-danger">*</span></label>
                                <input type="text" name="heading" value="{{ old('heading') }}"
                                       class="form-control @error('heading') is-invalid @enderror"
                                       placeholder="e.g. Performing Arts Summer Camp for Young Dreamers">
                                @error('heading') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Lead text --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Lead Paragraph</label>
                                <textarea name="lead_text" rows="3" class="form-control"
                                          placeholder="Short intro paragraph (larger text)...">{{ old('lead_text') }}</textarea>
                            </div>

                            {{-- Body text --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Body Paragraph</label>
                                <textarea name="body_text" rows="4" class="form-control"
                                          placeholder="Main description text...">{{ old('body_text') }}</textarea>
                            </div>

                            <hr>

                            {{-- Mini Stats (3 items) --}}
                            <p class="fw-semibold mb-2"><i class="fa fa-bar-chart me-1 text-primary"></i> Mini Stats (3 small highlight boxes)</p>
                            <div class="row g-3 mb-4">
                                @for($i = 0; $i < 3; $i++)
                                <div class="col-md-4">
                                    <div class="card border bg-light mb-0">
                                        <div class="card-body p-2">
                                            <small class="text-muted fw-semibold d-block mb-1">Stat {{ $i + 1 }}</small>
                                            <input type="text" name="mini_stat_num[]"
                                                   value="{{ old('mini_stat_num.'.$i) }}"
                                                   class="form-control form-control-sm mb-1"
                                                   placeholder="Number e.g. 500">
                                            <input type="text" name="mini_stat_label[]"
                                                   value="{{ old('mini_stat_label.'.$i) }}"
                                                   class="form-control form-control-sm"
                                                   placeholder="Label e.g. Kids Participated">
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>

                            <hr>

                            {{-- Image --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Section Image</label>
                                <input type="file" name="image" id="imageInput"
                                       accept="image/jpeg,image/png,image/webp"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImg(this)">
                                <div class="form-text text-muted">JPG, PNG, WEBP — max 3MB. Shown on the right side.</div>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div id="imgPreviewWrap" class="mt-2" style="display:none;">
                                    <img id="imgPreview" src="" style="height:100px;border-radius:8px;object-fit:cover;">
                                </div>
                            </div>

                            <hr>

                            {{-- Badge --}}
                            <p class="fw-semibold mb-2"><i class="fa fa-tag me-1 text-warning"></i> Orange Badge (top-right of image)</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Badge Year</label>
                                    <input type="text" name="badge_year" value="{{ old('badge_year') }}"
                                           class="form-control" placeholder="e.g. 2025">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Badge Text</label>
                                    <input type="text" name="badge_text" value="{{ old('badge_text') }}"
                                           class="form-control" placeholder="e.g. Summer Camp">
                                </div>
                            </div>

                            {{-- Floating card --}}
                            <p class="fw-semibold mb-2"><i class="fa fa-credit-card me-1 text-success"></i> Floating Info Card (bottom-left of image)</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Card Title</label>
                                    <input type="text" name="fc_title" value="{{ old('fc_title') }}"
                                           class="form-control" placeholder="e.g. Recognised by Govt. of Rajasthan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Card Subtitle</label>
                                    <input type="text" name="fc_subtitle" value="{{ old('fc_subtitle') }}"
                                           class="form-control" placeholder="e.g. Deputy CM & Education Minister attended">
                                </div>
                            </div>

                            <hr>

                            {{-- Buttons --}}
                            <p class="fw-semibold mb-2"><i class="fa fa-mouse-pointer me-1 text-info"></i> Action Buttons</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 1 Label</label>
                                    <input type="text" name="btn1_label" value="{{ old('btn1_label', 'Call Us Now') }}"
                                           class="form-control" placeholder="e.g. Call Us Now">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 1 URL</label>
                                    <input type="text" name="btn1_url" value="{{ old('btn1_url', 'tel:9119118844') }}"
                                           class="form-control" placeholder="tel:9119118844">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 2 Label</label>
                                    <input type="text" name="btn2_label" value="{{ old('btn2_label', 'WhatsApp') }}"
                                           class="form-control" placeholder="e.g. WhatsApp">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Button 2 URL</label>
                                    <input type="text" name="btn2_url" value="{{ old('btn2_url') }}"
                                           class="form-control" placeholder="https://wa.me/...">
                                </div>
                            </div>

                            <hr>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           name="status" id="status" value="1"
                                           {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="status">Active (visible on site)</label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save About Section
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Guide</div></div>
                    <div class="card-body small text-muted" style="line-height:2">
                        <p class="mb-1"><strong>Heading</strong> — Large title at the top</p>
                        <p class="mb-1"><strong>Lead</strong> — Larger intro text below heading</p>
                        <p class="mb-1"><strong>Body</strong> — Main paragraph text</p>
                        <p class="mb-1"><strong>Mini Stats</strong> — 3 small blue boxes (e.g. 500+ Kids)</p>
                        <p class="mb-1"><strong>Image</strong> — Right-side photo</p>
                        <p class="mb-1"><strong>Badge</strong> — Orange tag on the photo</p>
                        <p class="mb-1"><strong>Floating Card</strong> — White card bottom-left of photo</p>
                        <p class="mb-0"><strong>Buttons</strong> — Call & WhatsApp action buttons</p>
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
        document.getElementById('imgPreview').src = e.target.result;
        document.getElementById('imgPreviewWrap').style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

</script>
@endsection
