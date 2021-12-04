<div class="card-body">
    {{-- filters --}}
    <div>
        <div class="row d-flex justify-content-between px-4 mb-3">
            <div class="col-3">
                <div class="row mx-2">
                    <div wire:ignore class="col">
                        <Select wire:model='countryFilter' class="form-control p-1" id="countryFilter">
                            <option selected value=>{{ __('All Countries') }}</option>
                            @foreach ($countries as $index => $country)
                                <option value="{{ $index }}">{{ $country }}</option>
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
                    <th class="border-bottom-0">{{ __('Image') }}</th>
                    <th class="border-bottom-0">{{ __('Name') }}</th>
                    <th class="border-bottom-0">{{ __('Gender') }}</th>
                    <th class="border-bottom-0">{{ __('Age') }}</th>
                    <th class="border-bottom-0">{{ __('E-mail') }}</th>
                    <th class="border-bottom-0">{{ __('Phone') }}</th>
                    <th class="border-bottom-0">{{ __('Country') }}</th>
                    <th class="border-bottom-0">{{ __('Courses') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img alt="{{ $student->name }}" src="{{ asset('storage/' . $student->avatar) }}"
                                class="img-fluid img-thumbnail rounded-circle" style="max-width: 6rem">
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gen }}</td>
                        <td>{{ $student->age }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->city->country->name }}</td>
                        <td><i wire:click="select({{ $student->id }}, 'toViewCourses')" data-toggle="modal"
                                href="#coursesList" class="fas fa-envelope-open-text tx-22 tx-success"
                                type="button"></i></td>
                    </tr>
                @empty
                    <tr class="tx-center">
                        <td colspan="9">{{ __('No results found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="row mx-3">{{ $students->links() }} </div>
    @livewire('admin.students.assign-courses-to-students', ['user' => $user, 'notInReports' => false])
</div>
