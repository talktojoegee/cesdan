<p><strong class="text-info">Instruction:</strong> Use the checkbox to select the courses you intend to register.
<strong>{{$exam->exam_name ?? '' }}</strong> costs <i class="text-info">{{ number_format($exam->cost_per_paper,2) }}</i> per paper.
</p>
<div class="table-responsive">
    <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
        <thead>
            <tr>
                <th class="">#</th>
                <th></th>
                <th class="wd-15p">Course</th>
            </tr>
        </thead>

        <tbody>
        @php $serial = 1; @endphp
        @foreach($courses as $course)
            <tr>
                <td>{{ $serial++ }}</td>
                <td><label class="colorinput">
                        <input  name="course[]" type="checkbox" value="{{ $course->id }}" class="colorinput-input" />
                        <span class="colorinput-color bg-teal"></span>
                    </label>
                </td>
                <td>{{ $course->course ?? ''  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
