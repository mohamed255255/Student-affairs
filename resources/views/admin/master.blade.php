<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 9 CRUD Application</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <style>
        footer {
            background-color: #f3f1f1;
            padding: 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
            right: 4px;
        }
        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-menu a:hover {
            color: #1cd01c;
        }
        .dropdown-menu.show {
            display: block;
        }

    </style>
</head>
<body>
    <nav>
        <div class="logo"><i class="fa-brands fa-algolia" style="margin-right: 5px;"></i>FCI</div>
        <ul class="ul_nav">
            <a href="{{ route('admin.index') }}" style="text-decoration: none;">
                <li class="li_nav" id="current_tab"><i class="fas fa-home"></i>@lang('public.Home')</li></a>
            <a href="{{ route('admin.notification') }}" style="text-decoration: none;">
                <li class="li_nav" id="current_tab"><i class="fa-regular fa-bell" style="color: #1c1c1c;"></i>@lang('public.Notifications')</li>
            </a>
            <div class="dropdown">
                <li class="li_nav" onclick="toggleDropdown()">
                    <i class="fa-solid fa-earth-americas"></i>@lang('public.LANGUAGES')
                </li>
                <div id="myDropdown" class="dropdown-menu">
                    <a href="{{ route('languageConverter', 'ar') }}"> @lang('public.Arabic') </a>
                    <a href="{{ route('languageConverter', 'en') }}"> @lang('public.English')</a>
                </div>
            </div>

        </ul>
    </nav>
    <div class="container mt-5">
        @yield('content')
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> @lang("public.footer")</p>
    </footer>

<script>

    function toggleDropdown() {
        var dropdownMenu = document.getElementById("myDropdown");
        var isDropdownVisible = dropdownMenu.classList.contains("show");

        if (isDropdownVisible) {
            dropdownMenu.classList.remove("show");
        } else {
            dropdownMenu.classList.add("show");
            document.addEventListener('click', closeDropdownOutside);
        }
    }

    function closeDropdownOutside(event) {
        var dropdownMenu = document.getElementById("myDropdown");

        // Check if the clicked element is inside the dropdown
        var isClickInsideDropdown = dropdownMenu.contains(event.target);

        // Check if the clicked element is the dropdown button
        var isClickOnDropdownButton = event.target.classList.contains('li_nav');

        // If the clicked element is neither inside the dropdown nor the dropdown button, hide the dropdown
        if (!isClickInsideDropdown && !isClickOnDropdownButton) {
            dropdownMenu.classList.remove('show');
            // Remove the event listener after hiding dropdown
            document.removeEventListener('click', closeDropdownOutside);
        }
    }


</script>
</body>
</html>

