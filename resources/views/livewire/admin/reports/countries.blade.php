<div class="card-body">
    {{-- filters --}}
    <div>
        <div class="row d-flex justify-content-between px-4 mb-3">
            <div class="col-3">
               {{-- //other filters --}}
            </div>
            <div class="col-2">
                <input wire:model='search' type="search" placeholder="{{ __('Search...') }}"
                    class="form-control mb-3 h-6">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="rolesTable" class="table text-md-nowrap">
            <thead>
                <tr class="text-center">
                    <th class="border-bottom-0">#</th>
                    <th class="border-bottom-0">{{ __('Name') }}</th>
                    <th class="border-bottom-0">{{ __('Courses Count') }}</th>
                    <th class="border-bottom-0">{{ __('Instructors Count') }}</th>
                    <th class="border-bottom-0">{{ __('Students Count') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($countries as $country)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->courses->count() }}</td>
                        <td>{{ $country->instructors->count() }}</td>
                        <td>{{ $country->students->count() }}</td>
                    </tr>
                @empty
                    <tr class="tx-center">
                        <td colspan="9">{{ __('No results found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{ $countries->links() }} </div>
</div>
