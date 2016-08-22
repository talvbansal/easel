<script type="text/javascript">
    $(document).ready(function(){
        $("#data-table-tags").bootgrid({
            labels: {
                noResults: "No tags yet."
            },
            css: {
                icon: 'zmdi icon',
                iconColumns: 'zmdi-view-module',
                iconDown: 'zmdi-sort-amount-desc',
                iconRefresh: 'zmdi-refresh',
                iconUp: 'zmdi-sort-amount-asc'
            },
            formatters: {
                "commands": function(column, row) {
                    return "<a href='/admin/tag/" + row.id + "/edit'><button type='button' class='btn btn-icon command-edit waves-effect waves-circle'><span class='zmdi zmdi-edit'></span></button></a> ";
                }
            }
        });
    });
</script>
