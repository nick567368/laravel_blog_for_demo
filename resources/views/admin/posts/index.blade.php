@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('frontend._search')
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><a href="{{ url("/admin/posts") }}" class="">All</a></td>
                            </tr>
                            @forelse ($categorys as $category)
                            <tr>
                                <td> <a href="{{ url("/admin/posts/category/{$category->id}") }}" class="">{{ $category->name }}</a>
                                </td>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No category available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>
                        Posts

                        <a href="{{ url('admin/posts/create') }}" class="btn btn-default pull-right">Create New</a>
                    </h2>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ str_limit($post->body, 60) }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->tags->implode('name', ', ') }}</td>
                                <td>
                                    @if (Auth::user())
                                    @php
                                    if($post->published == 'Yes') {
                                    $label = 'Published Post';
                                    } else {
                                    $label = 'Not Published Post';
                                    }
                                    @endphp
                                    <a href="" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-sm">{{ $label }}</a>
                                    @endif

                                </td>
                                <td>
                                    @if (Auth::user())
                                    @php
                                    if($post->published == 'Yes') {
                                    $label = 'Draft';
                                    } else {
                                    $label = 'Publish';
                                    }
                                    @endphp
                                    <a href="{{ url("/admin/posts/{$post->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-sm-primary btn-primary">{{ $label }}</a>
                                    @endif
                                    <a href="{{ url("/admin/posts/{$post->id}") }}" class="btn btn-xs btn-success">Show</a>
                                    <a href="{{ url("/admin/posts/{$post->id}/edit") }}" class="btn btn-xs btn-info">Edit</a>
                                    <a href="{{ url("/admin/posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Are you sure?" class="btn btn-xs btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No post available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {!! $posts->links() !!}

                </div>
            </div>
        </div>

    </div>
</div>
@endsection