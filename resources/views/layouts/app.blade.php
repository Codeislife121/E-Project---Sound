<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sound Group') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #FF3366;
            --primary-glow: rgba(255, 51, 102, 0.4);
            --secondary: #161623;
            --secondary-light: #1E1E2C;
            --dark: #0A0A10;
            --light: #F4F4F9;
            --gray: #A0A0B0;
            --sidebar-width: 260px;
            --glass: rgba(22, 22, 35, 0.85);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }

        body {
            background-color: var(--dark); color: var(--light); display: flex; min-height: 100vh;
            background-image: radial-gradient(circle at top right, rgba(255, 51, 102, 0.04), transparent 50%),
                              radial-gradient(circle at bottom left, rgba(80, 51, 255, 0.04), transparent 50%);
        }

        /* Navbar */
        .navbar {
            background: var(--glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.03);
            padding: 0.8rem 2.5rem; display: flex; justify-content: space-between; align-items: center;
            position: fixed; top: 0; left: 0; right: 0; height: 75px; z-index: 100;
        }
        .navbar .logo {
            font-size: 1.8rem; font-weight: 800; text-decoration: none; letter-spacing: -0.5px;
            background: linear-gradient(90deg, #FFFFFF, var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .navbar ul { display: flex; list-style: none; gap: 2rem; align-items: center; }
        .navbar a, .navbar button {
            color: var(--light); text-decoration: none; font-weight: 500; transition: all 0.3s ease; font-size: 0.95rem;
        }
        .navbar a:hover, .navbar button:hover { color: var(--primary); text-shadow: 0 0 12px var(--primary-glow); }

        .container { display: flex; width: 100%; margin-top: 75px; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width); background: var(--secondary); border-right: 1px solid rgba(255,255,255,0.02);
            padding: 2.5rem 1.5rem; position: fixed; top: 75px; bottom: 0; left: 0; overflow-y: auto;
        }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        
        .sidebar h3 {
            margin-top: 1.8rem; margin-bottom: 1rem; color: var(--gray); font-size: 0.8rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;
        }
        .sidebar ul { list-style: none; }
        .sidebar li { margin-bottom: 0.4rem; }
        .sidebar a {
            color: var(--gray); text-decoration: none; display: block; padding: 0.7rem 1rem; border-radius: 10px; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); font-weight: 500;
        }
        .sidebar a:hover {
            background: rgba(255, 51, 102, 0.08); color: var(--primary); transform: translateX(4px);
        }

        .main-content {
            flex: 1; margin-left: var(--sidebar-width); padding: 3rem 4rem; width: calc(100% - var(--sidebar-width));
        }

        /* Forms & Buttons */
        .btn {
            background: linear-gradient(135deg, var(--primary), #D62852); color: #fff; padding: 0.8rem 1.8rem; border: none; border-radius: 50px; cursor: pointer; text-transform: uppercase; font-weight: 700; font-size: 0.85rem; letter-spacing: 1px; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 4px 15px var(--primary-glow); display: inline-block; text-decoration:none; text-align: center;
        }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(255, 51, 102, 0.5); }
        .btn-sm { padding: 0.5rem 1rem; font-size: 0.75rem; }
        .btn-danger { background: #E74C3C; box-shadow: 0 4px 15px rgba(231,76,60,0.3); }
        .btn-danger:hover { box-shadow: 0 8px 25px rgba(231,76,60,0.5); }

        .form-group { margin-bottom: 1.2rem; }
        .form-control {
            width: 100%; padding: 0.9rem 1.2rem; background: rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.08); color: var(--light); border-radius: 10px; transition: all 0.3s; font-family: 'Outfit', sans-serif; font-size: 0.95rem;
        }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 4px rgba(255,51,102,0.15); background: rgba(0,0,0,0.4); }
        
        .alert { padding: 1.2rem; margin-bottom: 1.5rem; border-radius: 10px; font-weight: 500; }
        .alert-success { background: rgba(46, 204, 113, 0.1); border-left: 4px solid #2ecc71; color: #2ecc71; }
        .alert-error { background: rgba(231, 76, 60, 0.1); border-left: 4px solid #e74c3c; color: #e74c3c; }

        /* Media Cards */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 2.5rem; }
        .card {
            background: var(--secondary-light); border-radius: 16px; overflow: hidden; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative; text-decoration: none; color: inherit; box-shadow: 0 5px 20px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.03); display: flex; flex-direction: column;
        }
        .card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.5), 0 0 20px rgba(255,51,102,0.1); border-color: rgba(255,51,102,0.3); }
        .card .img-wrapper { overflow: hidden; height: 220px; position:relative; }
        .card img { width: 100%; height: 100%; object-fit: cover; transition: all 0.6s ease; }
        .card:hover img { transform: scale(1.08); filter: brightness(1.1); }
        
        /* Card Overlay Gradient */
        .card .img-wrapper::after {
            content:''; position:absolute; inset:0; background: linear-gradient(to top, var(--secondary-light) 0%, transparent 50%); z-index: 1;
        }
        
        .card-body { padding: 1.5rem; position: relative; z-index: 2; margin-top: -30px; display:flex; flex-direction:column; flex:1; }
        .card h4 { margin-bottom: 0.4rem; font-size: 1.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--light); font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.5); }
        .card p { color: var(--gray); font-size: 0.9rem; font-weight: 400; line-height: 1.5;}
        
        .badge-new {
            position: absolute; top: 15px; right: 15px; background: var(--primary); color: white; font-size: 0.7rem; padding: 4px 12px; border-radius: 20px; font-weight: 800; letter-spacing: 1px; z-index: 3; box-shadow: 0 4px 12px var(--primary-glow); text-transform: uppercase;
        }

        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 1rem; border-radius: 12px; overflow:hidden; }
        th, td { padding: 16px; text-align: left; background: var(--secondary); border-bottom: 1px solid rgba(255,255,255,0.03); }
        th { background: rgba(0,0,0,0.3); font-weight: 700; color: var(--gray); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--secondary-light); }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">SoundGroup</a>
        <div style="flex:1; max-width: 500px; margin: 0 3rem;">
            <form action="{{ route('search') }}" method="GET" style="display:flex; position:relative;">
                <input type="text" name="title" placeholder="Search for music, videos, artists..." class="form-control" style="border-radius: 30px; padding: 0.8rem 1.5rem; padding-right: 110px; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1);">
                <button type="submit" class="btn" style="position:absolute; right: 4px; top: 4px; bottom: 4px; padding: 0 1.5rem; box-shadow:none;">Search</button>
            </form>
        </div>
        <ul>
            @guest
                <li><a href="{{ route('login') }}">Log In</a></li>
                <li><a href="{{ route('register') }}" class="btn" style="padding: 0.6rem 1.5rem;">Sign Up Free</a></li>
            @endguest
            @auth
                @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" style="color:var(--primary);">Admin Dashboard</a></li>
                @endif
                <li><span style="color:var(--gray);">Welcome, <strong style="color:var(--light);">{{ auth()->user()->name }}</strong></span></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none; border:none; cursor:pointer;" class="nav-link">Logout</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>

    <div class="container">
        <aside class="sidebar">
            <ul style="margin-bottom: 2rem;">
                <li><a href="{{ route('home') }}">✨ Discover</a></li>
                <li><a href="{{ route('search') }}">🔍 Advanced Search</a></li>
            </ul>

            @php
                try {
                    $sidebarCategories = \App\Models\Category::all();
                } catch (\Exception $e) {
                    $sidebarCategories = collect();
                }
            @endphp
            
            <h3>Top Artists</h3>
            <ul>
                @foreach($sidebarCategories->where('type', 'artist')->take(6) as $cat)
                    <li><a href="{{ route('search', ['category_id' => $cat->id]) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
            <h3 style="margin-top:2rem;">Genres</h3>
            <ul>
                @foreach($sidebarCategories->where('type', 'genre') as $cat)
                    <li><a href="{{ route('search', ['category_id' => $cat->id]) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
