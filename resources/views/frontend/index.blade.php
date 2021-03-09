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
                                <td><a href="{{ url("/") }}" class="">All</a></td>
                            </tr>
                            @forelse ($categorys as $category)
                            <tr>
                                <td> <a href="{{ url("/category/{$category->id}") }}" class="">{{ $category->name }}</a>
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
            @forelse ($posts as $post)
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $post->title }} - <small>by {{ $post->user->name }}</small>

                    <span class="pull-right">
                        {{ $post->created_at->toDayDateTimeString() }}
                    </span>
                </div>

                <div class="panel-body">
                    <p>{{ str_limit($post->body, 200) }}</p>
                    <p>
                        Tags:
                        @forelse ($post->tags as $tag)
                        <span class="label label-default">{{ $tag->name }}</span>
                        @empty
                        <span class="label label-danger">No tag found.</span>
                        @endforelse
                    </p>
                    <p>
                        <span class="btn btn-sm btn-success">{{ $post->category->name }}</span>
                        <span class="btn btn-sm btn-info">Comments <span class="badge">{{ $post->comments_count }}</span></span>

                        <a href="{{ url("/posts/{$post->id}") }}" class="btn btn-sm btn-primary">See more</a>
                    </p>
                </div>
            </div>
            @empty
            <div class="panel panel-default">
                <div class="panel-heading">Not Found!!</div>

                <div class="panel-body">
                    <p>Sorry! No post found.</p>
                </div>
            </div>
            @endforelse

            <div align="center">
                {!! $posts->links() !!}
            </div>

        </div>

        </dev>
        </dev>
        @endsection