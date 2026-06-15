
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found Login</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#2563eb,#7c3aed);
        }

        .container{
            width:900px;
            display:flex;
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,0.2);
        }

        .left{
            flex:1;
            background:linear-gradient(135deg,#1e3a8a,#7c3aed);
            color:white;
            padding:50px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .left h1{
            font-size:42px;
            margin-bottom:15px;
        }

        .left p{
            font-size:18px;
            line-height:1.6;
            opacity:0.9;
        }

        .right{
            flex:1;
            padding:50px;
        }

        .right h2{
            text-align:center;
            margin-bottom:30px;
            color:#1e293b;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            color:#475569;
            font-weight:600;
        }

        .form-group input{
            width:100%;
            padding:12px;
            border:1px solid #cbd5e1;
            border-radius:10px;
            outline:none;
        }

        .form-group input:focus{
            border-color:#2563eb;
        }

        .remember{
            margin-bottom:20px;
        }

        .btn-login{
            width:100%;
            padding:14px;
            border:none;
            background:#2563eb;
            color:white;
            border-radius:10px;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
        }

        .btn-login:hover{
            background:#1d4ed8;
        }

        .forgot{
            display:block;
            text-align:right;
            margin-bottom:15px;
            text-decoration:none;
            color:#2563eb;
        }

        .register{
            text-align:center;
            margin-top:20px;
        }

        .register a{
            color:#2563eb;
            text-decoration:none;
            font-weight:bold;
        }

        .error{
            color:red;
            font-size:14px;
            margin-top:5px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="left">
        <h1>🎒 Lost & Found</h1>
        <p>
            Find. Report. Recover.
            <br><br>
            A smart platform that helps students and staff report lost items,
            track their status, and recover belongings quickly.
        </p>
    </div>

    <div class="right">

        <h2>Login to Your Account</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    required
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">
                    Forgot Password?
                </a>
            @endif

            <div class="remember">
                <input type="checkbox" name="remember">
                Remember Me
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>

            @if(Route::has('register'))
            <div class="register">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>
            @endif

        </form>

    </div>

</div>

</body>
</html>
