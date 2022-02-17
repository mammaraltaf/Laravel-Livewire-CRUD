<div>
    @include('livewire.create')
    @include('livewire.update')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>All Students
                                        <button wire:click="resetInputFields" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                                            Add New Student
                                        </button>
                                    </h3>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="col-md-3">
                                    <input  wire.model="search" style="text-align: right" type="text" class="form-control" placeholder="Search"></input>
                                </div>
                            </div>

                            </h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody wire.loading wire:target="search">
                                    @foreach($students as $stu)
                                        <tr>
                                            <td>{{$stu->firstname}}</td>
                                            <td>{{$stu->lastname}}</td>
                                            <td>{{$stu->email}}</td>
                                            <td>{{$stu->phone}}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updateStudentModal" wire:click.prevent="edit({{$stu->id}})">Edit</button>
                                                <button type="button" class="btn btn-danger" wire:click.prevent="delete({{$stu->id}})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-center">
                                    {{$students -> links()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
