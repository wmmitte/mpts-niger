<div>
    @if (!$forRenewal)
        <form wire:submit.prevent="handlerBtn">
            @csrf
            @include('backoffice.partials.demand-employee-form')
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <div class="col-12 text-right">
                            <button class="btn btn-success" type="submit">
                                {{$btnName}}
                                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
    @livewire('employee.all-for-demand', ['demand' => $demand])
    @endif
</div>
