<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Credencial</title>
        <!-- Favicon -->
        <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
        @if($admin_favicon == '')
            <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
        @else
            <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
        @endif

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <img class="background" src="{{ asset('images/credential.png') }}" alt="">
            @php
                $photo = asset('images/user-default.png');
                if($person->foto){
                    $photo = asset('storage/'.str_replace('.', '-cropped.', $person->foto));
                }
            @endphp
            <div class="container-photo">
                <img class="photo" src="{{ $photo }}" width="72%">
            </div>

            <div class="container-details">
                <div style="padding: 20px">
                    <table>
                        <tr>
                            <td style="text-align: right"><b>NOMBRE:</b></td>
                            <td>{{ Str::upper($person->nombre_completo) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>CI:</b></td>
                            <td>{{ $person->ci }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>CARGO:</b></td>
                            <td>{{ Str::upper($person->cargo) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <br>
                                <b>LUGAR DE VOTACIÓN</b> <br>
                                {{ Str::upper($person->localidad) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <style>
            body{
                margin: 0px;
                font-family: 'Roboto', sans-serif;
            }
            .container{
                position: relative;
                z-index: 10;
            }
            .background{
                width: 100%;
            }
            .container-photo {
                position: absolute;
                top: 0px;
                left: 0px;
                width:100%;
                text-align: center;
                z-index: -1;
            }
            .photo{
                margin-top: 12%;
            }
            .container-details {
                position: absolute;
                top: 50%;
                left: 0px;
                width:100%;
                /* text-align: center; */
            }
            .container-details td{
                font-size: 1.2rem;
                vertical-align: top
            }
        </style>
    </body>
</html>