<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th width="70">#</th>
        <th>Kategori</th>
        <th>Açıklama</th>
        <th width="20"></th>
        <th width="90"></th>
    </tr>
    </thead>
    <tbody>
    @include('livewire.admin.product.category-table-items', ['items' => $categories, 'multiplier'=>0])
    </tbody>
</table>

