<script>
    $(function () {
        let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {className: 'btn'})
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [
                    @can('table.select.multiple')
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                },
                {
                    orderable: false,
                    searchable: false,
                    targets: -1
                },
                @endcan
            ],
            select: {
                style: 'multi+shift',
                selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                    @can('table.select.multiple')
                {
                    extend: 'selectAll',
                    className: 'btn-primary',
                    text: '{{ trans('global.select_all') }}',
                    exportOptions: {
                        columns: ':visible'
                    },
                    action: function (e, dt) {
                        e.preventDefault()
                        dt.rows().deselect();
                        dt.rows({search: 'applied'}).select();
                    }
                },
                {
                    extend: 'selectNone',
                    className: 'btn-primary',
                    text: '{{ trans('global.deselect_all') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.copy')
                {
                    extend: 'copy',
                    className: 'btn-default',
                    text: '{{ trans('global.datatables.copy') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.csv')
                {
                    extend: 'csv',
                    className: 'btn-default',
                    text: '{{ trans('global.datatables.csv') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.excel')
                {
                    extend: 'excel',
                    className: 'btn-default',
                    text: '{{ trans('global.datatables.excel') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.pdf')
                {
                    extend: 'pdf',
                    className: 'btn-default',
                    text: '{{ trans('global.datatables.pdf') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.print')
                {
                    extend: 'print',
                    className: 'btn-default',
                    text: '{{ trans('global.datatables.print') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.colvis')
                {
                    extend: 'colvis',
                    className: 'btn-default',
                    text: '{{ trans('global.datatables.colvis') }}',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                    @endcan
                    @can('table.delete.multiple')
                {
                    text: '{{ trans('global.datatables.delete') }}',
                    url: "{{ route($crudName.'massDestroy') }}",
                    className: 'btn-danger',
                    action: function (e, dt, node, config) {
                        var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                headers: {'x-csrf-token': _token},
                                method: 'POST',
                                url: config.url,
                                data: {ids: ids, _method: 'DELETE'}
                            })
                                .done(function () {
                                    location.reload()
                                })
                        }
                    }
                },
                    @endcan
                    @can('trash.view')
                    @if( Request::input('trashed') == 'true' )
                {
                    text: 'Show Active',
                    className: 'btn-success',
                    titleAttr: 'Show Active items',
                    init: function (dt, node, config) {
                        $(node).click(function () {
                            window.location.href = '{{Request::url()}}?trashed=false'
                        })
                    }

                }
                    @else
                {
                    text: 'Show Deleted',
                    className: 'btn-warning',
                    titleAttr: 'Show Deleted items',
                    init: function (dt, node, config) {
                        $(node).click(function () {
                            window.location.href = '{{Request::url()}}?trashed=true'
                        })
                    }

                },
                    @endif
                    @endcan
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
    });

</script>
