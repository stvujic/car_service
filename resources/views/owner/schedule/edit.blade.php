@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <h2 class="mb-4">Edit Working Hours for: {{ $workshop->name }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <p><strong>There were some errors:</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('owner_schedule_working_hours_upsert', $workshop->id) }}" method="POST">
            @csrf

            @php
                $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
            @endphp

            @foreach($days as $index => $day)
                @php
                    $existing = $workshop->workingHours->firstWhere('day_of_week', $index);
                    $isWorkingDay = $existing ? $existing->is_working_day : 0;
                @endphp

                <div class="card mb-3">
                    <div class="card-header">
                        <strong>{{ $day }}</strong>
                    </div>

                    <div class="card-body">

                        <input type="hidden" name="items[{{ $index }}][day_of_week]" value="{{ $index }}">

                        <div class="row g-3">

                            <div class="col-md-3">
                                <label class="form-label">Working Day?</label>
                                <select name="items[{{ $index }}][is_working_day]"
                                        class="form-select working-select"
                                        data-index="{{ $index }}">
                                    <option value="1" {{ $isWorkingDay == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $isWorkingDay == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="col-md-9 time-fields-{{ $index }}"
                                 style="{{ $isWorkingDay ? '' : 'display:none;' }}">

                                <div class="row g-3">

                                    <div class="col-md-3">
                                        <label>Open Time</label>
                                        <input type="time"
                                               name="items[{{ $index }}][open_time]"
                                               class="form-control"
                                               @if($existing && $existing->open_time)
                                                   value="{{ Carbon::parse($existing->open_time)->format('H:i') }}"
                                            @endif
                                        >
                                    </div>

                                    <div class="col-md-3">
                                        <label>Close Time</label>
                                        <input type="time"
                                               name="items[{{ $index }}][close_time]"
                                               class="form-control"
                                               @if($existing && $existing->close_time)
                                                   value="{{ Carbon::parse($existing->close_time)->format('H:i') }}"
                                            @endif
                                        >
                                    </div>

                                    <div class="col-md-3">
                                        <label>Break Start</label>
                                        <input type="time"
                                               name="items[{{ $index }}][break_start]"
                                               class="form-control"
                                               @if($existing && $existing->break_start)
                                                   value="{{ Carbon::parse($existing->break_start)->format('H:i') }}"
                                            @endif
                                        >
                                    </div>

                                    <div class="col-md-3">
                                        <label>Break End</label>
                                        <input type="time"
                                               name="items[{{ $index }}][break_end]"
                                               class="form-control"
                                               @if($existing && $existing->break_end)
                                                   value="{{ Carbon::parse($existing->break_end)->format('H:i') }}"
                                            @endif
                                        >
                                    </div>

                                </div>
                            </div>

                            <div class="closed-label-{{ $index }}"
                                 style="{{ $isWorkingDay ? 'display:none;' : '' }}">
                                <p class="text-muted mt-2">Closed all day</p>
                            </div>

                        </div>
                    </div>
                </div>


            @endforeach

            <button type="submit" class="btn btn-primary">
                Save Working Hours
            </button>

        </form>
    </div>


    <!-- JAVASCRIPT FOR SHOW/HIDE -->
    <script>
        document.querySelectorAll('.working-select').forEach(select => {
            select.addEventListener('change', function () {
                const i = this.dataset.index;

                const timeFields = document.querySelector('.time-fields-' + i);
                const closedLabel = document.querySelector('.closed-label-' + i);

                if (this.value === '1') {
                    timeFields.style.display = 'block';
                    closedLabel.style.display = 'none';
                } else {
                    timeFields.style.display = 'none';
                    closedLabel.style.display = 'block';
                }
            });
        });
    </script>

@endsection
