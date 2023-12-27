@extends('layout.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('user.update', ['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit User</h3>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                            value="{{ $data['email'] }}" placeholder="Enter email" />
                                        @error('email')
                                            <small>{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label for="exampleInputNama1">Profil</label>
                                            @if ($data['profil'])
                                                <div class="card pl-2 py-1" id="preview">
                                                    <p>{{ $data['filename'] }}</p>
                                                    <button id="change-btn" class="btn btn-danger ml-2">Ganti</button>
                                                </div>
                                                <input type="file"  id="actual" name="profil" class="d-none form-control"
                                                    id="Inputpotoprofil">
                                            @else
                                                <input type="file" id="actual" name="profil" class="form-control"
                                                    id="Inputpotoprofil">
                                            @endif
                                            @error('profil')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputNama1">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="exampleInputNama1"
                                                value="{{ $data['name'] }}" placeholder="Enter Nama" />
                                            @error('email')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword1" placeholder="Password">
                                            @error('password')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    {{-- </form> --}}
                                </div><!-- /.container-fluid -->
                            </div>
                        </div>
                    </div>


                </form>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        const preview = document.getElementById("preview");
        const changeBtn = document.getElementById("change-btn")
        const actualIn = document.getElementById("actual")

        changeBtn.addEventListener("click", ev => {
            ev.preventDefault();
            preview.style.display = "none";
            changeBtn.style.display = "none";
            actualIn.classList.remove("d-none");

        })
    </script>
@endpush
