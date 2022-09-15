<div wire:ignore>
    <textarea
        id="{!! str_replace('.', '-', $model) !!}"
        @if ($defer ?? true)
            wire:model.defer="{{ $model }}"
        @else
            wire:model.lazy="{{ $model }}"
        wire:dirty.class="border-danger"
        @endif
        class="form-control form-control-sm ckeditor @if($errors->has($model)) border-danger @endif"
        @if ($placeholder ?? null) placeholder="{{ $placeholder }}" @endif
        @if ($disabled ?? null) disabled @endif>


    </textarea>

    @push('custom-scripts')
        <script>
            window.addEventListener("load", (e)=> {
                ClassicEditor
                    .create(document.querySelector('#{!! str_replace('.', '-', $model) !!}'), {
                        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                            ]
                        }
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                        @this.set('{{$model}}', editor.getData());
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
    @endpush

</div>
@error($model) <span class="text-danger">{{ $message }}</span> @enderror
