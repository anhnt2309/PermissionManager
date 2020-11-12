{{-- relationships with pivot table (n-n) --}}
<span>
    <?php
    // Gets the attribute to display the permission name
    $attribute = Arr::get($column, 'attribute');
    $permissions = $entry->{$column['entity']};
    // Groups permissions by prefix, sorted alphabetically
    $permissionsByPrefix = collect($permissions)
        ->sortBy(function($permission) {
            return $permission->prefix() ?: PHP_INT_MAX; // Use PHP_INT_MAX as a little trick for sorting permissions without prefix at the end
        })
        ->groupBy(function($permission) {
            return $permission->prefix();
        });
    ?>

    @if ($permissionsByPrefix->isNotEmpty())

        @foreach ($permissionsByPrefix as $prefix => $permissions)

            @if (!$loop->first)
                @if (Arr::get($column, 'inline'))
                    ,
                @else
                    <br />
                @endif
            @endif
            <span class="badge badge-dark">
                <strong>
                    {{ ucfirst($prefix) }}
                </strong>
            </span>
            :
            <?php
            $sameTablePermission = $permissions->map(function($permission) use ($attribute) {
                    if (is_callable($attribute)) {
                        return $attribute($permission);
                    } elseif (is_string($attribute)) {
                        return $permission->$attribute;
                    } else {
                        return $permission->item();
                    }
            });
            ?>
            @foreach ($sameTablePermission as $prefix => $tablePermission)
            <span class="badge badge-secondary">
                <i style="font-weight:500">
                    {{ $tablePermission }}
                </i>
            </span>
            @endforeach

        @endforeach

    @else
        -
    @endif
</span>
