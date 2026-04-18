@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Forms</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Forms</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Basic Form</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Update Record for Blogs Posts</div>
                        </div>
                        <form action="{{ route('admin.blog-update', $blog->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="title">Title</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                                    name="title" onkeyup="makeSlug(this.value)"
                                                    value="{{ old('title', $blog->title) }}" placeholder="Enter Title" />
                                                @error('title')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                                <small id="titleHelp2" class="form-text text-muted">This title your blogs
                                                    title.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="slug">Slug</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    value="{{ $blog->slug }}" placeholder="slug" />

                                                <small id="slug" class="form-text text-muted">create a slug from your
                                                    title.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="short_descripition">Select Category</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select name="category_id" id="category_id" class="form-select select2"
                                                    style="width: 100%;">
                                                    <option value="">-- Select Category --</option>
                                                    @foreach ($blog_categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="image">Image</label>
                                            </div>
                                            <div class="col-md-9">
                                                <x-file-upload name="image" label="Upload Image" :current="$blog->image" />
                                                <small id="image" class="form-text text-muted">This Image show in your
                                                    blogs Image section.
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="short_descripition">Short Description</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea id="short_description" class="form-control" row="4" name="short_description">{{ $blog->short_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="descripition">Description</label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea id="myeditor" name="description">{{ $blog->description }}</textarea>
                                            </div>
                                        </div>

                                        {{-- LinkedIn Post --}}
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="linkedin_post">
                                                    <i class="fab fa-linkedin" style="color:#0a66c2;"></i>
                                                    LinkedIn Post
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="linkedin_post" id="linkedin_post" rows="4"
                                                    placeholder="Paste LinkedIn post URL or full embed iframe code">{{ old('linkedin_post', $blog->linkedin_post) }}</textarea>
                                                <small class="form-text text-muted">
                                                    Paste either a LinkedIn post URL (e.g. https://www.linkedin.com/posts/...)
                                                    or the full embed <code>&lt;iframe&gt;</code> code from LinkedIn.
                                                </small>
                                            </div>
                                        </div>

                                        {{-- Instagram Post --}}
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label for="instagram_post">
                                                    <i class="fab fa-instagram text-danger"></i>
                                                    Instagram Post
                                                </label>
                                            </div>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="instagram_post" id="instagram_post" rows="4"
                                                    placeholder="Paste Instagram post URL or full embed blockquote code">{{ old('instagram_post', $blog->instagram_post) }}</textarea>
                                                <small class="form-text text-muted">
                                                    Paste either an Instagram post URL (e.g. https://www.instagram.com/p/...)
                                                    or the full embed <code>&lt;blockquote&gt;</code> code from Instagram.
                                                </small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Tags</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="tags[]" class="form-select select2" multiple style="width:100%;">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}" {{-- old() on validation fail, otherwise load existing tags --}}
                                                    {{ in_array($tag->id, old('tags', $blog->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">
                                            Select one or more tags.
                                            <a href="{{ route('admin.blog-tags.index') }}" target="_blank">+ Manage
                                                tags</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action text-center">
                                <button class="btn btn-success" type="submit">Add Blogs</button>
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
        function makeSlug(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug').val(output);
        }
    </script>
@endsection
