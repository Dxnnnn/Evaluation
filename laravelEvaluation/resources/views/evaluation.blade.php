<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Linked CSS with Cache Busting -->
    <link rel="stylesheet" href="{{ asset('evaluation_form.css') }}?v={{ time() }}">

</head>
<body>

<div class="evaluation-container">

    <h2 class="evaluation-header">EVALUATION FORM</h2>

    @php
        $statements = [
            'Demonstrates professionalism at work.',
            'Communicates effectively with others.',
            'Shows initiative and responsibility.',
            'Meets deadlines and manages tasks efficiently.',
            'Exhibits teamwork and collaboration skills.'
        ];

        $submittedData = session('evaluation_data');
        $submittedAt = session('submitted_at');
        $now = \Carbon\Carbon::now();
        $canEdit = $submittedAt ? $now->diffInHours(\Carbon\Carbon::parse($submittedAt)) < 24 : false;
    @endphp

    {{-- ===================== READ-ONLY VIEW AFTER SUBMISSION ===================== --}}
    @if($submittedData)
        <p><strong>Submitted at:</strong> {{ $submittedAt }}</p>

        <div class="rating-table-container">
            <table class="rating-table">
                <thead>
                    <tr>
                        <th>Statement</th>
                        @for($i=1;$i<=5;$i++)
                        <th>{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($statements as $index => $statement)
                        <tr>
                            <td class="statement">{{ $statement }}</td>
                            @for($i=1;$i<=5;$i++)
                                <td>
                                    <input type="radio" disabled {{ $submittedData['ratings'][$index] == $i ? 'checked' : '' }}>
                                    {{ $submittedData['ratings'][$index] == $i ? $i : '' }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p><strong>Remarks:</strong></p>
        <p>{{ $submittedData['remarks'] }}</p>

        <!-- Action Button -->
        <div class="evaluation-actions">
            <button class="edit-btn" onclick="handleEdit()">EDIT</button>
        </div>

        {{-- ===================== EDIT FORM (HIDDEN UNTIL EDIT CLICKED) ===================== --}}
        <form id="editForm" method="POST" action="{{ route('evaluation.submit') }}" style="display:none; margin-top:20px;">
            @csrf

            <div class="employee-id-group">
                <label for="employee_id">Employee ID#</label>
                <input type="text" id="employee_id" name="employee_id" class="employee-id-input" value="{{ $submittedData['employee_id'] }}" required>
            </div>

            <div class="rating-table-container">
                <table class="rating-table">
                    <thead>
                        <tr>
                            <th>Statement</th>
                            @for($i=1;$i<=5;$i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statements as $index => $statement)
                            <tr>
                                <td class="statement">{{ $statement }}</td>
                                @for($i=1;$i<=5;$i++)
                                    <td>
                                        <input type="radio" name="statement_{{ $index }}" value="{{ $i }}" required
                                            {{ $submittedData['ratings'][$index] == $i ? 'checked' : '' }}>
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="remarks-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="remarks-input">{{ $submittedData['remarks'] }}</textarea>
            </div>

            <!-- Horizontal Buttons -->
            <div class="evaluation-actions">
                <button type="submit" class="submit-btn">SAVE CHANGES</button>
                <button type="button" class="edit-btn" onclick="window.location.reload()">CANCEL</button>
            </div>

        </form>

    @else
    {{-- ===================== NEW SUBMISSION FORM ===================== --}}
        <form method="POST" action="{{ route('evaluation.submit') }}">
            @csrf

            <div class="employee-id-group">
                <label for="employee_id">Employee ID#</label>
                <input type="text" id="employee_id" name="employee_id" class="employee-id-input" required>
            </div>

            <div class="rating-table-container">
                <table class="rating-table">
                    <thead>
                        <tr>
                            <th>Statement</th>
                            @for($i=1;$i<=5;$i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statements as $index => $statement)
                            <tr>
                                <td class="statement">{{ $statement }}</td>
                                @for($i=1;$i<=5;$i++)
                                    <td><input type="radio" name="statement_{{ $index }}" value="{{ $i }}" required></td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="remarks-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="remarks-input" placeholder="Type your remarks here..."></textarea>
            </div>

            <div class="evaluation-actions">
                <button type="submit" class="submit-btn">SUBMIT</button>
                <button type="button" class="edit-btn" onclick="window.history.back()">CANCEL</button>
            </div>

        </form>
    @endif

</div>

<script>
function handleEdit() {
    const canEdit = {{ $canEdit ? 'true' : 'false' }};
    if (!canEdit) return alert("You can only edit within 24 hours.");

    document.getElementById('editForm').style.display = 'block';
    window.scrollTo(0, document.getElementById('editForm').offsetTop);
}
</script>

</body>
</html>
