<h1 style="color:red;">TEST SIDEBAR</h1>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
            Site Settings
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('admin.slider.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('about.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('contact.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Contact Us</p>
            </a>
        </li>

    </ul>
</li>