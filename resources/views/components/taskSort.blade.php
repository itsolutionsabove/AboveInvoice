<div>
    <!-- Your existing content -->
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sort Itmes</h3>
                    </div>
                    <div class="card-body">
                        <ul id="task-sort-list" class="list-group">
                            @foreach($data as $item)
                                <li class="list-group-item" data-id="{{ $item->id }}" id="item-{{ $item->id }}">
                                    {{ $item->name ?? $item->title ?? 'Unnamed Item' }}
                                    <i class="fa fa-bars float-end"></i>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="history.back()" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>&nbsp; Back
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script wire:ignore>
    document.addEventListener('DOMContentLoaded', () => {
        let el = document.getElementById('task-sort-list');
        let sortable = new Sortable(el, {
            animation: 150,
            onEnd: function (evt) {
                let order = [], list = document.querySelectorAll('#task-sort-list .list-group-item');
                Array.from(list).reverse().forEach(function (item, index) {
                    order.push({
                        id: item.getAttribute('data-id'),
                        order: index + 1
                    });
                });
                @this.call('updateOrder', order);
            }
        });
    })
</script>

