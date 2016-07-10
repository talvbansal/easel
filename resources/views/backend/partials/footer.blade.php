<footer id="footer">
    &copy; {{ \Carbon\Carbon::today()->format('Y') }} {{ config('blog.title') }}. Code released under the <a href="https://github.com/austintoddj/Canvas/blob/master/LICENSE" target="_blank">MIT License</a>

    <ul class="f-menu">
        <li><a href="{{url('admin/profile')}}">Profile</a></li>
        <li><a href="{{url('admin/post')}}">Posts</a></li>
        <li><a href="{{url('admin/tag')}}">Tags</a></li>
        <li><a href="{{url('admin/upload')}}">Uploads</a></li>
        <li><a href="https://austintoddj.github.io/Canvas">Support</a></li>
        <li><a href="mailto:austin.todd.j@gmail.com">Contact</a></li>
    </ul>
</footer>