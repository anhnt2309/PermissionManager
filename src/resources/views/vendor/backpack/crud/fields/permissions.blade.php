<!-- permissions -->
@include('crud::fields.inc.wrapper_start')
<div class="form-group col-md-12 checklist" >

    @if (!empty($field['label']))
        <label>{!! $field['label'] !!}</label>
    @endif

    {{-- @include('crud::inc.field_translatable_icon') --}}

    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right">
                <button class="btn btn-dark btn-xs uncheck-all mb-1" title="Uncheck all">
                    <i class="las la-minus-square"></i>&nbsp; None
                </button>
                &nbsp;
                <button href="" class="btn btn-primary btn-xs check-all mb-1" title="Check all">
                    <i class="las la-check-square"></i>&nbsp; All
                </button>
            </div>
        </div>
    </div>

    @foreach ($field['model']::all()->groupBy(function($permission) { return $permission->prefix(); }) as $prefix => $permissions)
        <hr/>
        <div class="row">
                <div class="col-sm-3">
                    <label class="no-margin">
                        <strong>
                            <i class="las la-table"></i>{{ ucfirst($prefix) }}
                        </strong>
                    </label>
                </div>
                <div class="col-sm-7 permission-list">
                    @foreach ($permissions as $permission)
                        <div class="checkbox inline p-2">
                            <label class="font-weight-normal">
                                <input
                                    type="checkbox"
                                    name="{{ $field['name'] }}[]"
                                    value="{{ $permission->getKey() }}"
                                    @if( ( old( $field["name"] ) && in_array($permission->getKey(), old( $field["name"])) ) || (isset($field['value']) && in_array($permission->getKey(), $field['value']->pluck($permission->getKeyName(), $permission->getKeyName())->toArray())))
                                        checked = "checked"
                                    @endif > {!! ucfirst($permission->item()) !!} &nbsp;
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-2">
                    <div class="pull-right">
                        <button href="" class="btn btn-dark btn-xs uncheck-row mb-1" title="Uncheck all" class="">
                            <i class="las la-minus-square"></i>&nbsp; None
                        </button>
                        &nbsp;
                        <button href="" class="btn btn-primary btn-xs check-row mb-1" title="Check all">
                            <i class="las la-check-square"></i>&nbsp; All
                        </button>
                    </div>
                </div>
        </div>
    @endforeach

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
@include('crud::fields.inc.wrapper_end')
{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
    <!-- include checklist js-->
    <script>
        jQuery(document).ready(function($) {
            $('.checklist').each(function(index, item) {
                var $field = $(this);
                /**
                 * Check/uncheck all
                 */
                $field.find('.check-row').on('click', function(event) {
                    event.preventDefault();
                    $(this).closest('.row').find('.checkbox input').prop('checked', true);
                    return false;
                });
                $field.find('.uncheck-row').on('click', function(event) {
                    event.preventDefault();
                    $(this).closest('.row').find('.checkbox input').prop('checked', false);
                    return false;
                });
                $field.find('.check-all').on('click', function(event) {
                    event.preventDefault();
                    $field.find('.checkbox input').prop('checked', true);
                    return false;
                });
                $field.find('.uncheck-all').on('click', function(event) {
                    event.preventDefault();
                    $field.find('.checkbox input').prop('checked', false);
                    return false;
                });
            });
        });
    </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
