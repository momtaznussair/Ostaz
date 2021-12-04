<div class="card-body">
    {{-- filters --}}
    <div>
        <div class="row d-flex justify-content-between px-4 mb-3">
            <div class="col-3">
                <div class="row mx-2">
                    <div wire:ignore class="col">
                        <Select wire:model='category' class="form-control p-1" id="category">
                            <option selected value=>{{ __('Categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </Select>
                    </div>
                </div>
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
                    <th class="border-bottom-0">{{ __('Category') }}</th>
                    <th class="border-bottom-0">{{ __('Instructor') }}</th>
                    <th class="border-bottom-0">{{ __('Students Count') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->category ? $course->category->name : __('Deleted')}}</td>
                        <td>{{ $course->instructor ? $course->instructor->name : __('Deleted') }}</td>
                        <td>{{ $course->student_count }}</td>
                    </tr>
                @empty
                    <tr class="tx-center">
                        <td colspan="9">{{ __('No results found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{ $courses->links() }} </div>
</div>

