@extends('layouts.master')

@section('title', 'TAC PRESS | Product Sub Categories')

@section('content')

    <x-breadcrumb>Product Sub Categories</x-breadcrumb>

    <div class="app-content">
        <div class="container-fluid">

            <x-error-notification :errors="$errors->all()"/>

            <div class="col-md-12">
                <div class="card mb-4">

                    <x-datatable.card-header :icon="'list'" :title="'Product Sub Categories'">

                    </x-datatable.card-header>

                    @php
                        $checkData = 1;
                        if(empty($categories->toArray()))
                            $checkData = 0;
                    @endphp

                    <div class="card-body p-0 mb-3">
                        <x-datatable.datatable :checkData="$checkData" :headers="[
                            ['name' => '#', 'width' => '10%'],
                            'Category Name',
                            ['name' => 'Action', 'width' => '30%', 'classes' => 'no-sort']
                        ]">

                            @forelse ($categories as $key => $category)
                                <tr class="align-middle">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-title="Add Sub Categories - {{ $category->name }}" data-bs-url="form_view/createSubCategories/{{ $category->id }}" data-bs-size="modal-lg"> Values</button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="align-middle">
                                    <td colspan="10">No Data</td>
                                </tr>
                            @endforelse
                        </x-datatable.datatable>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div>
        </div> <!-- /.container-fluid -->
    </div> <!--end::App Content-->

    <x-call-modal />

    <x-call-modal-toggle />

@endsection

