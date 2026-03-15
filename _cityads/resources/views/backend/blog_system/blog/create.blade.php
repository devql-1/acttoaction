{{-- resources/views/backend/blog_system/blog/create.blade.php --}}
@extends('backend.layout.app')
@section('content')

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Forms</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Blog System</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item">Add Blog Post</li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Add Record for Blogs Posts</div>
          </div>

          <form action="{{ route('admin.blog-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  {{-- Title --}}
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="title2">Title <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" name="title" id="title2"
                             onkeyup="makeSlug(this.value)"
                             value="{{ old('title') }}"
                             class="form-control @error('title') is-invalid @enderror"
                             placeholder="Enter Title">
                      @error('title')<p class="invalid-feedback">{{ $message }}</p>@enderror
                      <small class="form-text text-muted">This title is your blogs heading.</small>
                    </div>
                  </div>

                  {{-- Slug --}}
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="slug">Slug <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="slug" id="slug"
                             value="{{ old('slug') }}" placeholder="slug">
                      <small class="form-text text-muted">Creating a slug from your title.</small>
                    </div>
                  </div>

                  {{-- Category --}}
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label>Select Category</label>
                    </div>
                    <div class="col-md-9">
                      <select name="category_id" class="form-select select2">
                        <option value="">-- Select Category --</option>
                        @foreach($blog_categories as $category)
                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  {{-- ══════════════════════════════════════════════════════
                       AUTHOR DROPDOWN  (NEW)
                  ══════════════════════════════════════════════════════════ --}}
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label>Published By</label>
                    </div>
                    <div class="col-md-9">
                      <select name="author_id" id="authorSelect" class="form-select select2">
                        <option value="">-- Select Author --</option>
                        @foreach($blog_authors as $author)
                          <option value="{{ $author->id }}"
                            {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}{{ $author->designation ? ' — '.$author->designation : '' }}
                          </option>
                        @endforeach
                      </select>
                      <small class="form-text text-muted">
                        Who is publishing this post?
                        <a href="{{ route('admin.blog-author.create') }}" target="_blank">+ Create new author</a>
                      </small>

                      {{-- Live author preview card --}}
                      <div id="authorPreview" class="mt-3 d-none
                           p-3 border rounded d-flex align-items-center gap-3"
                           style="background:#f8f9fa;">
                        <img id="prevImg" src="" alt=""
                             class="rounded-circle flex-shrink-0"
                             style="width:56px;height:56px;object-fit:cover;border:2px solid #dee2e6;">
                        <div>
                          <strong id="prevName"></strong>
                          <div id="prevDesig" class="text-muted small"></div>
                          <div id="prevSocials" class="d-flex gap-2 mt-1"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- ══════════════════════════════════════════════════════ --}}

                  {{-- Image --}}
                  <div class="form-group row">
                    <div class="col-md-3"><label>Image</label></div>
                    <div class="col-md-9">
                      <x-file-upload name="image" label="Upload Image" />
                      <small class="form-text text-muted">This image shows in your blogs image section.</small>
                    </div>
                  </div>

                  {{-- Short Description --}}
                  <div class="form-group row">
                    <div class="col-md-3"><label>Short Description</label></div>
                    <div class="col-md-9">
                      <textarea class="form-control" name="short_description" rows="4">{{ old('short_description') }}</textarea>
                    </div>
                  </div>

                  {{-- Description --}}
                  <div class="form-group row">
                    <div class="col-md-3"><label>Description</label></div>
                    <div class="col-md-9">
                      <textarea id="myeditor" name="description">{{ old('description') }}</textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>{{-- /card-body --}}

            <div class="card-action text-center">
              <button class="btn btn-success" type="submit">Submit</button>
              <a href="{{ route('admin.blog') }}" class="btn btn-danger">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script>
// ── Slug generator (same as original) ─────────────────────────────────────
function makeSlug(val) {
    $('#slug').val(val.replace(/\s+/g, '-').toLowerCase());
}

// ── Author data for live preview ───────────────────────────────────────────
const authors = {
@foreach($blog_authors as $a)
    {{ $a->id }}: {
        name:  @json($a->name),
        desig: @json($a->designation ?? ''),
        img:   @json($a->image ? asset('img/authors/'.$a->image) : asset('img/default-author.png')),
        ig:    @json($a->instagram ?? ''),
        fb:    @json($a->facebook  ?? ''),
        tw:    @json($a->twitter   ?? ''),
        li:    @json($a->linkedin  ?? ''),
    },
@endforeach
};

function renderAuthorPreview(id) {
    const d = authors[id];
    if (!id || !d) { $('#authorPreview').addClass('d-none'); return; }

    $('#prevImg').attr('src', d.img);
    $('#prevName').text(d.name);
    $('#prevDesig').text(d.desig);

    let s = '';
    if (d.ig) s += `<a href="${d.ig}" target="_blank"><i class="fab fa-instagram text-danger"></i></a>`;
    if (d.fb) s += `<a href="${d.fb}" target="_blank"><i class="fab fa-facebook" style="color:#1877f2;"></i></a>`;
    if (d.tw) s += `<a href="${d.tw}" target="_blank"><i class="fab fa-x-twitter text-dark"></i></a>`;
    if (d.li) s += `<a href="${d.li}" target="_blank"><i class="fab fa-linkedin" style="color:#0a66c2;"></i></a>`;
    $('#prevSocials').html(s || '<span class="text-muted small">No social links</span>');

    $('#authorPreview').removeClass('d-none').addClass('d-flex');
}

$('#authorSelect').on('change', function () { renderAuthorPreview($(this).val()); });

// Show preview immediately if old() restored a value
@if(old('author_id'))
    renderAuthorPreview({{ old('author_id') }});
@endif
</script>
@endsection