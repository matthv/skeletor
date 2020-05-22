<div class="row mt-3">
    <div class="col-sm-12">
        <div class="card btns-save">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        @foreach($buttons as $k => $v)
                            <{{ array_key_exists('link', $v) ? 'a href=' . $v['link'] . ' ' . (array_key_exists('blank', $v) ? 'target="_blank"' : '') : 'button type="submit"' }} class="btn btn-{{ array_key_exists('css_class', $v) ? $v['css_class'] : 'primary' }}" name="{{ $k }}">
                            @foreach($v['icons'] as $icon)
                                <i class="fas {{ $icon }}"></i>
                            @endforeach
                            {{ $v['label'] }}
                    </{{ array_key_exists('link', $v) ? 'a' : 'button' }}>
                    @endforeach
                    </div>
                    <div class="col-auto ml-auto">
                        <em class="mt-2 d-block">* {{ __('skeletor::skeletor.required_fields') }}</em>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>