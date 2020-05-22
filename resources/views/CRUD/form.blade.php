{!! form_start($form, ['files' => $form->getData('hasFile')]) !!}
<div class="row mt-3">
    @if ($form->getData('blocks'))
        @foreach($form->getData('blocks') as $block)
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        @foreach($block as $field)
                            {!! form_row($form->{$field}) !!}
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        {!! form_rest($form) !!}
    @else
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {!! form_fields($form) !!}
                </div>
            </div>
        </div>
    @endif
</div>
@include('skeletor::CRUD.submit')
{!! form_end($form) !!}