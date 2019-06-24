<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: left;
        }

        .title {
            font-size: 16px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <script>
		document.addEventListener('DOMContentLoaded', function () {
			document.getElementById("mainBtn").addEventListener("click", function (e) {
				e.preventDefault();
				document.getElementById("loginResult").value = '';
				document.getElementById("weatherResult").value = '';

				fetch('/api/auth', {
					headers: new Headers({
						'Content-Type': 'application/json',
					}),
					credentials: 'omit',
					method: 'post',
					body: JSON.stringify({
						'login': document.getElementById("login").value,
						'password': document.getElementById("password").value,
					})
				}).then(response => response.json())
					.then(data => {
						document.getElementById("loginResult").value = JSON.stringify(data);
						if (!data.token) {
							throw new Error('token is empty')
						}
						return data.token;
					})
					.then(token => {
						fetch('/api/weather', {
							credentials: 'omit',
							headers: new Headers({
								'X-API-TOKEN': token,
                                'Content-Type': 'application/json',
							}),
							method: 'get'
						})
							.then(response => response.json())
							.then(data => {
								document.getElementById("weatherResult").value = JSON.stringify(data);
							})
							.catch(error => console.log(error));

					})
					.catch((data) => console.log(data));
			});
		});
    </script>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <form id="mainForm">
                <p>
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login"/>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password"/>
                </p>
                <p>
                    <button type="submit" id="mainBtn">OK</button>
                </p>
            </form>
        </div>
        <textarea id="loginResult"></textarea>
        <textarea id="weatherResult"></textarea>
    </div>
</div>
</body>
</html>
