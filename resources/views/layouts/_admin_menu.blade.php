<ul class="nav navbar-nav">
    <li><a href="{{ url('admin/posts') }}">Posts</a></li>
    <li><a href="{{ url('admin/categories') }}">Categories</a></li>
    <li><a href="{{ url('admin/community-works') }}">Community Works</a></li>
    <li><a href="{{ url('admin/clients') }}">Client Management</a></li>

    @if (Auth::user()->is_admin)
        <li><a href="{{ url('admin/users') }}">Users</a></li>
    @endif
</ul>
