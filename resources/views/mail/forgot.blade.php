<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Восстановление пароля</title>
    <!-- Подключаем Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Стили для адаптации под мобильные устройства */
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }
        }

        /* Стили для адаптации под планшеты и небольшие ноутбуки */
        @media (min-width: 577px) and (max-width: 991px) {
            .container {
                padding: 20px;
            }
        }

        /* Стили для адаптации под средние и большие ноутбуки */
        @media (min-width: 992px) and (max-width: 1199px) {
            .container {
                padding: 30px;
            }
        }

        /* Стили для адаптации под десктопные устройства и большие мониторы */
        @media (min-width: 1200px) {
            .container {
                padding: 40px;
            }
        }

        /* Стили для центрирования элементов */
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Стили для карточки */
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
        }

        .card-body {
            padding: 15px;
        }

        .card-footer {
            border-top: 1px solid #ddd;
            padding: 10px 15px;
        }

        /* Стили для заголовка и текста в карточке */
        .card h3 {
            margin-top: 0;
        }

        .card p {
            margin-bottom: 0;
        }

        /* Стили для выделения нового пароля */
        .card strong {
            color: #007bff;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Восстановление пароля</h3>
                </div>
                <div class="card-body">
                    <p>Ваш новый пароль: <strong>{{ $password }}</strong></p>
                </div>
                <div class="card-footer text-center">
                    <p>Если вы не запрашивали восстановление пароля, проигнорируйте это сообщение.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
