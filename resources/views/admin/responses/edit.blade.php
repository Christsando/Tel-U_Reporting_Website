@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Respon Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('responses.update', $response->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Terkait Laporan</label>
            <input type="text"
                   class="form-control"
                   value="{{ class_basename($response->respondable_type) }} #{{ $response->respondable_id }}"
                   readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Pesan Respon</label>
            <textarea name="message"
                      class="form-control"
                      rows="5"
                      required>{{ old('message', $response->message) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status Tindakan</label>
            <select name="action_status" class="form-control" required>
                <option value="in_progress"
                    {{ old('action_status', $response->action_status) === 'in_progress' ? 'selected' : '' }}>
                    In Progress
                </option>
                <option value="resolved"
                    {{ old('action_status', $response->action_status) === 'resolved' ? 'selected' : '' }}>
                    Resolved
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('responses.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
