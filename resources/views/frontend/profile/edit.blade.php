@extends('frontend.layouts.apps')

@section('content')
<style>
    .profile-container {
        background-color: #f8e9d9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Membatasi lebar maksimal kotak */
        margin: 0 auto; /* Pusatkan kotak */
        margin-top: 100px; /* Menambahkan margin-top agar tidak tertutup navbar */
    }
    .profile-title {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .notification {
        display: none;
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
        position: fixed;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="notification" id="notification">Profil berhasil diperbarui!</div>
    <div class="profile-container">
        <h2 class="profile-title">Profil Saya</h2>
        <form id="profile-form" action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Nama</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" required>
                @error('nomor_hp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        @if(session('success'))
            $('#notification').slideDown().delay(3000).slideUp();
        @endif

        $('#profile-form').on('submit', function(event) {
            $('#notification').slideDown().delay(3000).slideUp();
        });
    });
</script>
@endsection
@endsection
