<footer id="footer">
    &copy; {{ date('Y') }} {{ config('blog.title') }}. Code released under the <a href="https://github.com/talv86/easel/blob/master/LICENSE" target="_blank">MIT License</a>

    <ul class="f-menu">
        <li><a href="{{url('admin/profile')}}">Profile</a></li>
        <li><a href="{{url('admin/post')}}">Posts</a></li>
        <li><a href="{{url('admin/tag')}}">Tags</a></li>
        <li><a href="{{url('admin/upload')}}">Uploads</a></li>
        <li><a href="https://github.com/talv86/easel/issues">Support</a></li>
        <li><a href="mailto:talvbansal@gmail.com">Contact</a></li>
    </ul>
</footer>