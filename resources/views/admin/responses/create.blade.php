<form method="POST" action="{{ route('responses.store') }}">
    @csrf

    <input type="hidden" name="respondable_type" value="{{ $respondable_type }}">
    <input type="hidden" name="respondable_id" value="{{ $respondable_id }}">

    <textarea name="message" required></textarea>

    <select name="action_status">
        <option value="">-- Optional --</option>
        <option value="in_progress">In Progress</option>
        <option value="resolved">Resolved</option>
    </select>

    <button type="submit">Kirim Respon</button>
</form>