<?php
$type = ['closed_question' => 'Вопросы закрытого типа']
?>

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

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

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .title {
            font-size: 40px;
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

    </style>
</head>
<body>
<div class="flex-center position-ref">

    <div class="content">
        <div class="title m-b-md" style="margin-bottom: 40px">
            CBR
            <small>Admin</small>
            <div class="btn-group" style="margin-left: 50px">
                <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    Создать голосование
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/add_page">Голосование закрытого типа</a>
                </div>
            </div>
        </div>


        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <td>
                    Заголовок
                </td>
                <td>
                    Категория
                </td>
                <td>
                    Голосов
                </td>
                <td>
                    Среднее
                </td>
                <td>
                    Время окончания голосования
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Vote::orderBy('created_at', 'DESC')->get() as $vote)

                <tr @if($vote->finish_time < date('Y-m-d',time())) style="color: black;background-color: rgba(255,0,2,0.38)" @endif>
                    <td>

                        <a href="/getdatavote/{{$vote->id}}" style="text-decoration: none ">
                            {{$vote->title}}
                        </a>

                    </td>
                    <td>
                        {{$type[$vote->type]}}
                    </td>
                    <td>
                        {{\App\ClosedQuestion::all()->where('id_votes',$vote->id)->count()}}
                    </td>
                    <td>
                        {{\App\ClosedQuestion::all()->where('id_votes',$vote->id)->avg('value')}}
                    </td>
                    <td>
                        {{$vote->finish_time}}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>


    </div>
</div>
</body>

</html>
