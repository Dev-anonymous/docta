<link rel="stylesheet" href="{{ asset('plugins/datatable/css.css') }}">
<script src="{{ asset('plugins/datatable/pdf.js') }}"></script>
<script src="{{ asset('plugins/datatable/vfs.js') }}"></script>
<script src="{{ asset('plugins/datatable/js.js') }}"></script>
<style>
    .dt-paging-button.page-item.active button {
        color: #fff !important;
    }

    .btn.buttons-collection.dropdown-toggle,
    .buttons-html5 {
        background-color: #6c757d !important
    }

    .dt-paging-button.page-item.active>.page-link {
        background-color: var(--appcolor) !important;
        border-radius: 50% !important
    }

    .dt-buttons.btn-group.flex-wrap {
        margin-bottom: 20px !important
    }

    div.dt-processing>div:last-child>div {
        background: var(--appcolor) !important;
    }
</style>
