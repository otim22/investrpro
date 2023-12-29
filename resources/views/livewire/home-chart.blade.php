<div>
    <div class="row">
        <div class="col-6">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <input type="checkbox" value="Savings" wire:model="types" wire:change="filterType" />
                    <span>Savings</span>
                </li>
                <li class="list-inline-item">
                    <input type="checkbox" value="Missed meeting" wire:model="types" wire:change="filterType" />
                    <span>Missed meeting</span>
                </li>
                <li class="list-inline-item">
                    <input type="checkbox" value="Late remission" wire:model="types" wire:change="filterType" />
                    <span>Late remission</span>
                </li>
                <li class="list-inline-item">
                    <input type="checkbox" value="other" wire:model="showDataLabels" wire:change="showDataLabel"/>
                    <span>Show data labels</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                <livewire:livewire-column-chart
                    key="{{ $columnChartModel->reactiveKey() }}"
                    :column-chart-model="$columnChartModel"
                />
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                {{-- <livewire:livewire-pie-chart
                    key="{{ $pieChartModel->reactiveKey() }}"
                    :pie-chart-model="$pieChartModel"
                /> --}}
            </div>
        </div>
    </div>
</div>
