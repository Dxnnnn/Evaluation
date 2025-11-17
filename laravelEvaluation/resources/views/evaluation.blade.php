<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Form</title>
    <link rel="stylesheet" href="{{ asset('evaluation_form.css') }}">
    <style>
        .evaluation-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: #f6f6f6;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .evaluation-header h2 {
            color: #4B0082;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #4B0082;
            color: white;
        }

        td.statement {
            text-align: left;
        }

        .remarks-textarea {
            width: 100%;
            min-height: 100px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            resize: vertical;
            font-size: 14px;
        }

        .form-actions {
            margin-top: 20px;
            display: flex;
            gap: 12px;
        }

        .submit-btn {
            background-color: #4B0082;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #3a006b;
        }

        .cancel-btn {
            background-color: #e0e0e0;
            color: #333;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .submit-info {
            margin-top: 20px;
            padding: 15px;
            background: #d9f0d9;
            border-left: 4px solid #4B0082;
            border-radius: 6px;
        }

        .edit-btn {
            background-color: #9ed7a6;
            color: #064b10;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        .readonly td input {
            display: none;
        }

        .readonly td {
            text-align: center;
        }

        .readonly td.statement {
            text-align: left;
        }

    </style>
</head>
<body>
<div class="evaluation-container">
    <div class="evaluation-header">
        <h2>Evaluation Form</h2>
        <p>Please fill out the form below.</p>
    </div>

    @php
        $statements = [
            'Demonstrates professionalism at work.',
            'Communicates effectively with others.',
            'Shows initiative and responsibility.',
            'Meets deadlines and manages tasks efficiently.',
            'Exhibits teamwork and collaboration skills.'
        ];

        $submittedData = session('evaluation_data', null);
        $submittedAt = session('submitted_at', null);
        $now = \Carbon\Carbon::now();
        $canEdit = $submittedAt ? $now->diffInHours(\Carbon\Carbon::parse($submittedAt)) < 24 : false;
    @endphp

    @if($submittedData)
        <div class="submit-info">
            <p><strong>Evaluation Submitted Successfully!</strong></p>
            <p>Submitted at: {{ $submittedAt }}</p>
        </div>

        <table class="readonly">
            <thead>
            <tr>
                <th>Statement</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statements as $index => $statement)
                <tr>
                    <td class="statement">{{ $statement }}</td>
                    @for($i=1; $i<=5; $i++)
                        <td>
                            <input type="radio" disabled {{ $submittedData['ratings'][$index] == $i ? 'checked' : '' }}>
                            {{ $submittedData['ratings'][$index] == $i ? $i : '' }}
                        </td>
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>

        <p><strong>Remarks:</strong></p>
        <p>{{ $submittedData['remarks'] }}</p>

        <button class="edit-btn" onclick="handleEdit()">Edit Evaluation</button>

        <form id="editForm" class="evaluation-form" method="POST" action="{{ route('evaluation.submit') }}" style="display:none; margin-top:20px;">
            @csrf
            <div class="form-group">
                <label for="employee_id">Employee ID#</label>
                <input type="text" id="employee_id" name="employee_id" class="form-input" value="{{ $submittedData['employee_id'] }}" required>
            </div>

            <div class="form-group">
                <label>Rate the employee (1 = Lowest, 5 = Highest). Please rate honestly and fairly.</label>
                <table>
                    <thead>
                    <tr>
                        <th>Statement</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statements as $index => $statement)
                        <tr>
                            <td class="statement">{{ $statement }}</td>
                            @for($i=1; $i<=5; $i++)
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

            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="remarks-textarea">{{ $submittedData['remarks'] }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit Edited Evaluation</button>
                <button type="button" class="cancel-btn" onclick="window.location.reload()">Cancel</button>
            </div>
        </form>

    @else
        <form class="evaluation-form" method="POST" action="{{ route('evaluation.submit') }}">
            @csrf

            <div class="form-group">
                <label for="employee_id">Employee ID#</label>
                <input type="text" id="employee_id" name="employee_id" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Rate the employee (1 = Lowest, 5 = Highest). Please rate honestly and fairly.</label>
                <table>
                    <thead>
                    <tr>
                        <th>Statement</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statements as $index => $statement)
                        <tr>
                            <td class="statement">{{ $statement }}</td>
                            @for($i=1; $i<=5; $i++)
                                <td>
                                    <input type="radio" name="statement_{{ $index }}" value="{{ $i }}" required>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="remarks-textarea" placeholder="Type your remarks here..."></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit Evaluation</button>
                <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
            </div>
        </form>
    @endif
</div>

<script>
    function handleEdit() {
        const canEdit = {{ $canEdit ? 'true' : 'false' }};
        if (!canEdit) {
            alert("You can only edit the form within 24 hours of submission.");
            return;
        }
        document.getElementById('editForm').style.display = 'block';
        window.scrollTo(0, document.getElementById('editForm').offsetTop);
    }
</script>
</body>
</html>
