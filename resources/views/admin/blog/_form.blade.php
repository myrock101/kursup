<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>

<div class="mb-3">
    <label for="title" class="form-label">Заголовок</label>
    <input type="text" class="form-control @error ('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?? $blog['title'] ?? '' }}">

    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label for="meta_keywords" class="form-label">keywords</label>
    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') ?? $blog['meta_keywords'] ?? '' }}">
</div>

<div class="mb-3">
    <label for="meta_description" class="form-label">meta_description</label>
    <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ old('meta_description') ?? $blog['meta_description'] ?? '' }}">
</div>

<div class="mb-3">
    <label for="editorDescription" class="form-label">Описание</label>
    <textarea class="form-control @error ('description') is-invalid @enderror quill-editor" id="editorDescription" rows="5" name="description">{{ old('description') ?? $blog['description'] ?? '' }}</textarea>

    @error('description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="mb-3 col-md-4">
    <label for="cover" class="form-label @error ('cover') is-invalid @enderror">Обложка</label>
    <input class="form-control" type="file" name="cover" id="cover">

    @error('cover')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

@section('scripts')
    @parent

    <script>
        $(function () {
            $('.quill-editor').each(function(i, el) {
                var el = $(this), id = 'quilleditor-' + i, val = el.val(), editor_height = 200;
                var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
                el.addClass('d-none');
                el.parent().append(div);

                var quill = new Quill('#' + id, {
                    theme: 'snow',
                    modules: {
                        'syntax': true,
                        'toolbar': [
                            [{ 'font': [] }, { 'size': [] }],
                            [ 'bold', 'italic', 'underline', 'strike' ],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
                            [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
                            [{ 'script': 'super' }, { 'script': 'sub' }],
                            [{ 'align': [] }],
                            [ 'link' ],
                        ]
                    }
                });
                quill.on('text-change', () => {
                    // el.val(quill.getContents());
                    el.val(quill.root.innerHTML);
                });
            });
        })


    </script>
@endsection

