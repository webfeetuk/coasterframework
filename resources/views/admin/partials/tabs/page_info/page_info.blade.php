<div class="form-group">
    <h4 class="col-sm-12">Page Details</h4>
</div>

@if ($pageSelect && !$page->id && $page->groups->isEmpty())
    {!! CmsBlockInput::make('select', ['name' => 'page_info[parent]', 'label' => 'Parent Page', 'content' => $pageSelect]) !!}
@else
    {!! Form::hidden('page_info[parent]', $page->parent, ['id' => 'page_info[parent]']) !!}
@endif

@if ($publishing_on && $page->id && $page->link == 0)
    <div class="form-group">
        <p class="col-sm-offset-2 col-sm-10">Page {{ $beacon_select ? 'beacons, ' : '' }}name and url are NOT versioned, changes to these will be made live on save.</p>
    </div>
@endif

@if ($beacon_select)
    {!! CmsBlockInput::make('selectmultiple', array('name' => 'page_info_other[beacons]', 'label' => 'Page Beacons', 'content' => $beacon_select)) !!}
@endif

{!! CmsBlockInput::make('string', ['name' => 'page_info_lang[name]', 'label' => 'Page Name', 'content' => $page_lang->name, 'disabled' => !$can_publish && $page->id ]) !!}

<div class="form-group {!! FormMessage::getErrorClass('page_info_lang[url]') !!}">
    {!! Form::label('page_info_lang[url]', 'Page Url:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <div id="url-group" class="input-group">
            @if (!$page->id || $page->link == 0)
                <span class="input-group-addon" id="url-prefix">{{ $urlArray[$urlPrefixPage] }}</span>
            @endif
            <?php $options = []; if (!$can_publish && $page->id): $options = ['disabled' => true]; endif; ?>
            {!! Form::text('page_info_lang[url]', urldecode($page_lang->url), ['class' => 'form-control', 'id' => 'page_info_url'] + $options) !!}
            @if (!$page->id || $page->link == 1)
                <span class="input-group-addon link_show">or</span>
                <span class="input-group-btn link_show">
                    <a href="{!! URL::to(config('coaster::admin.public').'/filemanager/dialog.php?type=2&field_id=page_info_url') !!}"
                       class="btn btn-default iframe-btn">Select Doc</a>
                </span>
            @endif
        </div>
        <span class="help-block">{!! FormMessage::getErrorMessage('page_info_lang[url]') !!}</span>
        @if (!$page->id)
            <div class="checkbox {!! FormMessage::getErrorClass('page_info[link]') !!}">
                <label>
                    {!! Form::checkbox('page_info[link]', 1, 0, ['id' => 'page_info[link]']) !!} Is direct link or document:
                </label>
            </div>
        @else
            {!! \Form::hidden('page_info[link]', $page->link, ['id' => 'page_info[link]']) !!}
        @endif
    </div>
</div>

<script type="text/javascript">
    var urlArray = {!! json_encode($urlArray) !!};
</script>